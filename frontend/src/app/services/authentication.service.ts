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
  private _username?: string;
  private _userId: number | null = null; // <<< ICI on autorise null proprement
  private _error: boolean = false;

  constructor(private http: HttpClient, private router: Router) {
    const savedToken = localStorage.getItem('token');
    const savedUsername = localStorage.getItem('username');

    if (savedToken) {
      this._token = savedToken;
      this.decodeToken(savedToken); // Décode dès le chargement
    }
    if (savedUsername) {
      this._username = savedUsername;
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

  public get username(): string {
    return this._username ?? '';
  }

  public get error(): boolean {
    return this._error;
  }

  public login(username: string, password: string): void {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    this.http.post<TokenResponse>(`${this.server}/auth`, { username, password }, { headers })
      .subscribe({
        next: (response) => {
          if (response?.token) {
            this._token = response.token;
            this._username = username;
            this._error = false;

            localStorage.setItem('token', response.token);
            localStorage.setItem('username', username);

            console.log("Token reçu :", response.token);

            this.decodeToken(response.token); // Décode après connexion

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
    this._username = undefined;
    this._userId = null; // <<< Remettre à null proprement
    localStorage.removeItem('token');
    localStorage.removeItem('username');
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

  private decodeToken(token: string): void {
    try {
      const payload = JSON.parse(atob(token.split('.')[1]));
      console.log('Payload décodé :', payload);

      this._userId = payload.id ?? null; // <<< Mettre l'id ou null proprement
    } catch (e) {
      console.error('Erreur en décodant le token :', e);
      this._userId = null;
    }
  }
}
