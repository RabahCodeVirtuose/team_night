import { Component } from '@angular/core';
import {FormControl, FormsModule, ReactiveFormsModule} from '@angular/forms';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatInputModule} from '@angular/material/input';
import {MatButtonModule} from '@angular/material/button';
import {AuthenticationService} from '../../services/authentication.service';
import {MatIcon} from '@angular/material/icon';

@Component({
  selector: 'app-login-component',
  imports: [
    MatFormFieldModule,
    MatInputModule,
    MatButtonModule,
    FormsModule,
    ReactiveFormsModule,
    MatIcon
  ],
  templateUrl: './login-component.component.html',
  styleUrl: './login-component.component.scss'
})
export class LoginComponentComponent {
  email = new FormControl('');
  password = new FormControl('');
  hidePassword = true;

  get isValid(): "" | undefined | string {
    return this.email.value?.trim() && this.password.value?.trim();
  }
  togglePasswordVisibility() {
    this.hidePassword = !this.hidePassword;
  }

  login() {
    this.auth.login(this.email.value!, this.password.value!);
  }

  constructor(public auth: AuthenticationService) {}
}
