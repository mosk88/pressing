import { Component, inject } from '@angular/core';
import { ServiceService } from '../../shared/service.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-services',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './services.component.html',
  styleUrl: './services.component.css'
})
export class ServicesComponent {
services$ = inject(ServiceService).fetchAll();
}
