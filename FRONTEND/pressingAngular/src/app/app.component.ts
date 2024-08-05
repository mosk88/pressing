import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { ServicesComponent } from './services/services.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet,ServicesComponent],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'pressingAngular';
}
