import {Component, HostListener} from '@angular/core';
import { RouterOutlet } from '@angular/router';
import {NavbarComponentComponent} from './components/navbar-component/navbar-component.component';
import {FooterComponentComponent} from './components/footer-component/footer-component.component';

@Component({
  selector: 'app-root',
  imports: [RouterOutlet, NavbarComponentComponent, FooterComponentComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.scss'
})
export class AppComponent {
  isNavbarVisible = true;
  private lastScrollTop = 0;
  private debounceTimeout: any;

  @HostListener('window:scroll', [])
  onScroll(): void {
    const scrollTop = document.documentElement.scrollTop;

    // Anti-flicker: on attend un peu avant d'agir
    clearTimeout(this.debounceTimeout);
    this.debounceTimeout = setTimeout(() => {
      const delta = scrollTop - this.lastScrollTop;

      if (delta > 20) {
        // scroll vers le bas → cache
        this.isNavbarVisible = false;
      } else if (delta < -10) {
        // scroll vers le haut → affiche
        this.isNavbarVisible = true;
      }

      this.lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, 50);
  }

}
