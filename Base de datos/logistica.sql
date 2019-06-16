DROP TABLE IF EXISTS tipodocumento CASCADE;
create table tipodocumento(
	id integer ,
	nombre varchar(100) not null,
	abreviatura varchar(10) not null,
	longitudmaxima integer not null,
	longitudminima integer not null,
    eslongitudfija boolean, --
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
	pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
    CONSTRAINT tipodocumento_pkey PRIMARY KEY (id)
);



create table unidad(
	id integer ,
	nombre varchar(50) not null,
	codigosunat character(10),
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
	pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT unidad_pkey PRIMARY KEY (id)
);
create table presentacion(
	id integer ,
	nombre varchar(100) not null,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
	pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT presentacion_pkey PRIMARY KEY (id)
);

create table marca(
	id integer ,
	nombre varchar(200) not null,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT marca_pkey PRIMARY KEY (id)
);

create table tipoproducto(
	id integer ,
	nombre varchar(100) not null,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
	pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT tipoproducto_pkey PRIMARY KEY (id)
);
create table producto(
	id integer ,
	nombre varchar(100) not null,
    codbarras varchar(16), -- Codigo de barras
    codfabricante varchar(16), -- Codigo de barras
    inventariable boolean NOT NULL,
    stockminimo integer,
    idtipoproducto integer,
    afectoigv boolean DEFAULT true,
    idunidad integer, -- Identificador de unidad
    idmarca integer, -- Identificador de unidad
    idpresentacion integer, -- Identificador de presentacion
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT producto_pkey PRIMARY KEY (id),
	CONSTRAINT producto_idunidad_fkey FOREIGN KEY (idunidad)
      REFERENCES unidad(id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT producto_idpresentacion_fkey FOREIGN KEY (idpresentacion)
      REFERENCES presentacion(id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT producto_idmarca_fkey FOREIGN KEY (idmarca)
      REFERENCES marca(id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT producto_idtipoproducto_fkey FOREIGN KEY (idtipoproducto)
      REFERENCES tipoproducto(id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
create table proveedor(
	id integer ,
	nombre varchar(200) not null,
	idtipodocum integer NOT NULL,
	numdocumento varchar(20) NOT NULL, -- num documento
    telefono varchar(13), --
    representante varchar(255), --
    email varchar(50), --
    clave varchar(255), --
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT proveedores_pkey PRIMARY KEY (id),
	CONSTRAINT tipodocum_fkey FOREIGN KEY (idtipodocum)
      REFERENCES tipodocumento (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

DROP TABLE IF EXISTS cotizacion CASCADE;
create table cotizacion(
	id integer ,
	fechacotizacion DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
	idrequerimiento integer,
	diascredito integer ,
	fechaentrega DATETIME NOT NULL DEFAULT now(),
	horaentrega TIMESTAMP ,
	lugarentrega varchar(255),
	fechavencimiento DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
	observacion text,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT cotizacion_pkey PRIMARY KEY (id)
);

DROP TABLE IF EXISTS cotizaciondetalle CASCADE;
create table cotizaciondetalle(
	id integer ,
	idcotizacion integer not null,
	idproducto integer not null,
    idunidad integer not null,
    cantidad numeric(9,2) not null,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT cotizaciondetalle_pkey PRIMARY KEY (id),
	CONSTRAINT cotizaciondetalle_cotizacion_fkey FOREIGN KEY (idcotizacion)
      REFERENCES cotizacion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT  cotizaciondetalle_producto_fkey FOREIGN KEY (idproducto)
      REFERENCES producto (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT  cotizaciondetalle_unidad_fkey FOREIGN KEY (idunidad)
      REFERENCES unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
DROP TABLE IF EXISTS cotizaciondetespecif CASCADE;
CREATE TABLE cotizaciondetespecif
(
  id integer,
  idcotizaciondetalle integer NOT NULL,
  detalle varchar (200) NOT NULL,
  estado boolean,
  usuario varchar(50),
  pc varchar(50),
  ip varchar(50),
  fecha DATETIME NOT NULL DEFAULT now(),
  usuariomod varchar(50),
  pcmod varchar(50),
  ipmod varchar(50),
  observacionmod varchar(100),
  fechamod DATETIME NOT NULL,
  CONSTRAINT cotizaciondetespecif_pkey PRIMARY KEY (id),
  CONSTRAINT cotizaciondetespecif_cotizaciondetalle_fkey FOREIGN KEY (idcotizaciondetalle)
      REFERENCES cotizaciondetalle (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

DROP TABLE IF EXISTS tipomoneda CASCADE;
create table tipomoneda(
	id integer ,
	nombre varchar(200) not null,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT tipomoneda_pkey PRIMARY KEY (id)
);
DROP TABLE IF EXISTS cotizacionproveedorcab CASCADE;
create table cotizacionproveedorcab(
	id integer ,
	idcotizacion integer not null,
	idproveedor integer not null ,
	idtipomoneda integer not nullm
    formapago varchar(100), -- Nombre de la PC donde se hizo el registro
    tiempoentrega varchar(100), -- Nombre de la PC donde se hizo el registro
	observacion text,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT cotizacionproveedorcab_pkey PRIMARY KEY (id),
	CONSTRAINT cotizacion_cotizacionproveedorcab_fkey FOREIGN KEY (idcotizacion)
      REFERENCES cotizacion (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT proveedor_cotizacionproveedorcab_fkey FOREIGN KEY (idproveedor)
      REFERENCES proveedor (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT tipomoneda_cotizacionproveedorcab_fkey FOREIGN KEY (idtipomoneda)
      REFERENCES tipomoneda (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
DROP TABLE IF EXISTS cotizacionproveedordet CASCADE;
create table cotizacionproveedordet(
	id integer ,
	idcotizacionproveedorcab integer not null,
	idproducto integer not null,
    idunidad integer not null,
    aniofab integer,
    idmarca integer,
    cantidad numeric(9,2) not null,
    preciounitario numeric(9,2) not null,
    observacion text,
    estado boolean, -- Estado del registro
    usuario varchar(50), -- Usuario que hizo el registo
    pc varchar(50), -- Nombre de la PC donde se hizo el registro
    ip varchar(50), -- IP desde donde se hizo el registro
    fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
    usuariomod varchar(50), -- Usuario que modifica el registro
    pcmod varchar(50), -- PC desde donde se hace la modificación
    ipmod varchar(50), -- IP desde donde se hace la modificacion
    observacionmod varchar(100), -- Observacion de la modificacion
    fechamod DATETIME NOT NULL,
	CONSTRAINT cotizacionproveedordet_pkey PRIMARY KEY (id),
	CONSTRAINT cotizacionproveedordet_cotizacionproveedor_fkey FOREIGN KEY (idcotizacionproveedorcab)
      REFERENCES cotizacionproveedorcab (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT  cotizacionproveedorcab_producto_fkey FOREIGN KEY (idproducto)
      REFERENCES producto (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT  cotizacionproveedorcab_unidad_fkey FOREIGN KEY (idunidad)
      REFERENCES unidad (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT  cotizacionproveedorcab_marca_fkey FOREIGN KEY (idmarca)
      REFERENCES marca (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
DROP TABLE IF EXISTS cotizacionproveedordetesp CASCADE;
CREATE TABLE cotizacionproveedordetesp
(
  id integer,
  idcotizacionproveedordet integer NOT NULL,
  detalle varchar (200) NOT NULL,
  estado boolean,
  usuario varchar(50),
  pc varchar(50),
  ip varchar(50),
  fecha DATETIME NOT NULL DEFAULT now(),
  usuariomod varchar(50),
  pcmod varchar(50),
  ipmod varchar(50),
  observacionmod varchar(100),
  fechamod DATETIME NOT NULL,
  CONSTRAINT cotizacionproveedordetesp_pkey PRIMARY KEY (id),
  CONSTRAINT cotizacionproveedordetesp_cotizacionproveedordet_fkey FOREIGN KEY (idcotizacionproveedordet)
      REFERENCES cotizacionproveedordet (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
CREATE TABLE parametro
(
  id integer, -- Identificador
  nombre varchar(30), -- Nombre (Ejm: Monto de cortesia)
  descripcion varchar(100), -- Descripcion detallada del parametro
  valor character(100), -- Valor
  estado boolean, -- Estado del registro
  usuario varchar(50), -- Usuario que hizo el registo
  pc varchar(50), -- Nombre de la PC donde se hizo el registro
  ip varchar(50), -- IP desde donde se hizo el registro
  fecha DATETIME NOT NULL DEFAULT now(), -- Fecha del registro
  usuariomod varchar(50), -- Usuario que modifica el registro
  pcmod varchar(50), -- PC desde donde se hace la modificación
  ipmod varchar(50), -- IP desde donde se hace la modificacion
  observacionmod varchar(100), -- Observacion de la modificacion
  fechamod DATETIME NOT NULL,
  CONSTRAINT parametro_pkey PRIMARY KEY (id)
);

