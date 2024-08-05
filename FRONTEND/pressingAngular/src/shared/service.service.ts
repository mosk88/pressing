import { Injectable } from '@angular/core';
import { environment } from '../environments/environment.development';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { IService } from './Entities';

@Injectable({
  providedIn: 'root'
})
export class ServiceService {
  urlService = environment.apiBaseUrl;
  constructor(private http: HttpClient) { }

  fetchAll(): Observable<IService[]> {
    return this.http.get<IService[]>(this.urlService + '/services');


  }
}
