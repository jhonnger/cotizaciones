import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {LocalstorageService} from './localstorage.service';
import {URL_SERVER} from '../global/config';
import {Observable, throwError} from 'rxjs';
import {catchError, map} from 'rxjs/operators';
import {UtilService} from './util.service';
import {Meta} from "@angular/platform-browser";

@Injectable({
  providedIn: 'root'
})
export class MantenimientoService {

  url: string;
  Authorization: string;

  constructor(private _http: HttpClient,
              private _router: Router,
              private _utilService: UtilService,
              private meta: Meta,
              private _localStorage: LocalstorageService) {
    this.url =  URL_SERVER;
  }
  getToken() {
    let token;

    token = this._localStorage.getData('token');
    return token || '';
  }


  guardar( url, data ): Observable<any> {
    let respuesta ;
    if (data.id == null || data.id == undefined) {
      respuesta = this._http.post( this.url + url , data , {
        headers: {
          Authorization: `Bearer ${this.getToken()}`,
          'X-CSRF-TOKEN': this.meta.getTag('name=csrf-token').content
        }
      });
    } else {
      respuesta = this._http.put( this.url + url , data , {
        headers: {
          Authorization: `Bearer ${this.getToken()}`,
          'X-CSRF-TOKEN': this.meta.getTag('name=csrf-token').content
        }
      });
    }

    return respuesta.pipe(
        map((res: any) => {
          if (!res) {
            throw new Error('Error al conectarse con el servidor');
          }
          return res;
        }),
        catchError(err => {
          return throwError(err);
        })
      );
  }
  enviarData( url, data ): Observable<any> {
    let respuesta ;

    respuesta = this._http.post( this.url + url , data , {
      headers: {
        Authorization: `Bearer ${this.getToken()}`,
        'X-CSRF-TOKEN': this.meta.getTag('name=csrf-token').content
      }
    });
    return respuesta.pipe(
        map((res: any) => {
          if (!res) {
            throw new Error('Error al conectarse con el servidor');
          }
          return res;
        }),
        catchError(err => {
          return throwError(err);
        })
      );
  }
  listar( url ): Observable<any> {

    return  this._http.get( this.url + url , {
      headers: {
        Authorization: `Bearer ${this.getToken()}`,
        'X-CSRF-TOKEN': this.meta.getTag('name=csrf-token').content
      }
    } )
       .pipe(
        map((res: any) => {
          if (!res) {
            throw new Error('Error al conectarse con el servidor');
          }
          return res;

        }),
        catchError(err => {
          return throwError(err);
        })
      );
  }
  busquedaPaginada( url, cantidad, pagina, filtro ): Observable<any> {

    return  this._http.post( this.url + url + `/cantidad/${cantidad}/pagina/${pagina}` , filtro,
      {headers: {
        Authorization: `Bearer ${this.getToken()}`,
        'X-CSRF-TOKEN': this.meta.getTag('name=csrf-token').content
      }})
       .pipe(
        map((res: any) => {
          if (!res) {
            throw new Error('Error al conectarse con el servidor');
          }
          return res;

        }),
        catchError(err => {
          return throwError(err);
        })
      );
  }
  obtener( url ): Observable<any> {

    return  this._http.get( this.url + url  , {
      headers: {
        Authorization: `Bearer ${this.getToken()}`,
        'X-CSRF-TOKEN': this.meta.getTag('name=csrf-token').content
      }})
       .pipe(
        map((res: any) => {

          return res;
        }),
        catchError(err => {
          return throwError(err);
        })
      );
  }
  eliminar( url, data ): Observable<any> {
    let respuesta ;

    respuesta = this._http.delete( this.url + url + data,
      {headers: {
          Authorization: `Bearer ${this.getToken()}`,
          'X-CSRF-TOKEN': this.meta.getTag('name=csrf-token').content
        }});
    return respuesta.pipe(
        map((res: any) => {
          if (!res) {
            throw new Error('Error al conectarse con el servidor');
          }
          return res;
        }),
        catchError(err => {
          return throwError(err);
        })
      );
  }
  renuevaToken() {

    return this._http.get(this.url + 'login/renovarToken?token', {headers: {Authorization: `Bearer ${this.getToken()}`}})

      .pipe(
        map((res: any) => {
          this._localStorage.saveData('token', res.token);
          return true;
        }),
        catchError(err => {
          console.log(err);
          return throwError(err);
        })
      );
  }
}
