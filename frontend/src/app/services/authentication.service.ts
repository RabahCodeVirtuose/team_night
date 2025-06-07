import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { Router } from '@angular/router';

interface TokenResponse {
  token: string;
}

@Injectable({
  providedIn: 'root'
})
export class AuthenticationService {

  private server = environment.backendURL;
  private _token?: string;
  private _email?: string;
  private _nom?: string | null = null;
  private _userId: number | null = null; // <<< ICI on autorise null proprement
  private _error: boolean = false;

  constructor(private http: HttpClient, private router: Router) {
    const savedToken = localStorage.getItem('token');
    const savedemail = localStorage.getItem('email');
    const savednom = localStorage.getItem('nom');
    if (savedToken) {
      this._token = savedToken;
      this.decodeToken(savedToken); // Décode dès le chargement
    }
    if (savedemail) {
      this._email = savedemail;
    }
    if(savednom) {
      this._nom = savednom;
    }
  }

  public reset_error(): void {
    this._error = false;
  }

  public get isAuthentified(): boolean {
    return this._token !== undefined;
  }

  public get token(): string {
    return this._token ?? '';
  }

  public get email(): string {
    return this._email ?? '';
  }

  public get nom(): string {
    return this._nom ?? '';
  }

  public get error(): boolean {
    return this._error;
  }

  public login(email: string, password: string): void {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    this.http.post<TokenResponse>(`${this.server}/auth`, { email, password }, { headers })
      .subscribe({
        next: (response) => {
          if (response?.token) {
            this._token = response.token;
            this._email = email;
            this._error = false;

            localStorage.setItem('token', response.token);
            localStorage.setItem('email', email);

            console.log("Token reçu :", response.token);

            this.decodeToken(response.token); // Décode après connexion
            this._nom = localStorage.getItem('nom');
            this.router.navigate(['/menu']);
          } else {
            this._error = true;
          }
        },
        error: (_) => {
          this._error = true;
        }
      });
  }

  public logout(): void {
    this._token = undefined;
    this._email = undefined;
    this._userId = null; // <<< Remettre à null proprement
    localStorage.removeItem('token');
    localStorage.removeItem('email');
    localStorage.removeItem('nom')
    this.router.navigate(['/login']);
  }

  public isAdmin(): boolean {
    const token = localStorage.getItem('token');
    if (!token) return false;

    try {
      const payload = JSON.parse(atob(token.split('.')[1]));
      return payload.roles.includes('ROLE_ADMIN');
    } catch {
      return false;
    }
  }

  public getUserId(): number | null {
    return this._userId;
  }
  public getNom() :string | null| undefined {
    return this._nom;
  }

  private decodeToken(token: string): void {
    try {
      const payload = JSON.parse(atob(token.split('.')[1]));
      console.log('Payload décodé :', payload);

      this._userId = payload.id ?? null;// <<< Mettre l'id ou null proprement
      this._nom = payload.nom ?? null;
      if (this._nom) {
        localStorage.setItem('nom', this._nom);
      }

    } catch (e) {
      console.error('Erreur en décodant le token :', e);
      this._userId = null;
    }
  }
}
