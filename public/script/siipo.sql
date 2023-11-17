DROP DATABASE IF EXISTS siipo;
CREATE DATABASE siipo;
USE siipo;

CREATE TABLE roles ( -- Tabla de Roles para el Usuario
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del rol
    NombreRol VARCHAR(20) UNIQUE NOT NULL, -- Nombre del rol
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
);

CREATE TABLE users ( -- Tabla de Usuarios
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del usuario
    Nombre VARCHAR(30) NOT NULL, -- Nombre del usuario
    CURP VARCHAR(18) UNIQUE NOT NULL, -- Curp del usuario
    Email VARCHAR(30), -- Correo electrónico del usuario
    Password VARCHAR(20) NOT NULL, -- Contraseña del usuario
    Rolid INT NOT NULL, -- Identificador del rol del usuario
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (Rolid) REFERENCES roles(id) -- Llave foránea del rol del usuario con el identificador del rol-Rolid
);

CREATE TABLE permisos ( -- Tabla para los permisos
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del permiso
    NombrePermiso VARCHAR(30) UNIQUE NOT NULL, -- Nombre del permiso
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP --Fecha de actualización
);

CREATE TABLE asignacion_permisos ( -- Tabla para la asignación de permisos a los roles
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del permiso asignado
    Rolid INT NOT NULL, -- Identificador del rol
    Perid INT NOT NULL, -- Identificador del permiso
    Permitido BOOLEAN DEFAULT FALSE NOT NULL, -- Indica si el permiso está permitido o no
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (Rolid) REFERENCES roles(id), -- Llave foránea del rol con el identificador del rol-Rolid
    FOREIGN KEY (Perid) REFERENCES permisos(id) -- Llave foránea del permiso con el identificador del permiso-Perid
);

CREATE TABLE regiones ( -- Tabla para las regiones
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador de la región
    NombreRegion VARCHAR(40) UNIQUE NOT NULL, -- Nombre de la región
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
);

CREATE TABLE distritos ( -- Tabla para los distritos
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del distrito
    NombreDistrito VARCHAR(30) UNIQUE NOT NULL, -- Nombre del distrito
    Regid INT NOT NULL, -- Identificador de la región
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (Regid) REFERENCES regiones(id) -- Llave foránea de la región con el identificador de la región-Regid
);

CREATE TABLE municipios ( -- Tabla para los municipios
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del municipio
    NombreMunicipio VARCHAR(30) NOT NULL, -- Nombre del municipio
    Disid INT NOT NULL, -- Identificador del distrito
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (Disid) REFERENCES distritos(id) -- Llave foránea del distrito con el identificador del distrito-Disid
);

CREATE TABLE localidades ( -- Tabla para las localidades
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador de la localidad
    NombreLocalidad VARCHAR(30) NOT NULL, -- Nombre de la localidad
    Munid INT NOT NULL, -- Identificador del municipio
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (Munid) REFERENCES municipios(id) -- Llave foránea del municipio con el identificador del municipio-Munid
);

CREATE TABLE oficinas ( -- Tabla para las oficinas
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador de la oficina
    NombreOficina VARCHAR(50) NOT NULL, -- Nombre de la oficina
    Ubicacion VARCHAR(100) NOT NULL, -- Ubicación de la oficina
    Telefono VARCHAR(10) NOT NULL, -- Teléfono de la oficina
    Email VARCHAR(40) NOT NULL, -- Email de la oficina
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
);



CREATE TABLE unidadeconomica_pa ( -- Tabla para las unidades económicas para los pescadores o acuacultores físicas y morales
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador de la unidad económica
    Ofcid INT NOT NULL, -- Identificador de la oficina
    FechaRegistro DATE NOT NULL, -- Fecha de registro de la unidad económica
    RNPA VARCHAR(50), -- RNPA del pescador o acuacultor
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (Ofcid) REFERENCES oficinas(id) -- Llave foránea de la oficina con el identificador de la oficina-Ofcid
);

CREATE TABLE datosgenerales_pa ( -- Tabla para los datos generales de los pescadores o acuacultores físicas y morales
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador de los datos generales
    TipoPersona BOOLEAN DEFAULT TRUE NOT NULL, -- Tipo persona Verdadero para física y Falso para moral
    CURP VARCHAR(18) UNIQUE NOT NULL, -- CURP del pescador o acuacultor
    RFCFisica VARCHAR(13), -- CURP del pescador o acuacultor físico
    RFCMoral VARCHAR(12), -- CURP del pescador o acuacultor moral
    RazonSocial VARCHAR(50) NOT NULL, -- Razon social del pescador o acuacultor moral
    Nombres VARCHAR(50) NOT NULL, -- Nombres del pescador o acuacultor físico
    ApPaterno VARCHAR(30) NOT NULL, -- Apellido paterno del pescador o acuacultor físico
    ApMaterno VARCHAR(30) NOT NULL, -- Apellido materno del pescador o acuacultor físico
    FechaNacimiento DATE NOT NULL, -- Fecha de nacimiento del pescador o acuacultor físico
    Sexo ENUM ('M', 'F') NOT NULL, -- Sexo del pescador o acuacultor físico
    GrupoSanguineo VARCHAR(4), -- Grupo sanguíneo del pescador o acuacultor físico
    Email VARCHAR(40), -- Email del pescador o acuacultor físico
    UEPAid INT NOT NULL, -- Id del pescador o acuacultor
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (UEPAid) REFERENCES unidadeconomica_pa(id) -- Llave foránea de la unidad económica-UEPAid
);

CREATE TABLE domicilio_pa ( -- Tabla para los domicilios de los pescadores o acuacultores físicas y morales
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del domicilio
    Calle VARCHAR(100) NOT NULL, -- Calle del domicilio
    NmExterior VARCHAR(6) NOT NULL, -- Número exterior del domicilio
    NmInterior VARCHAR(6) NOT NULL, -- Número interior del domicilio
    CodigoPostal VARCHAR(10), -- Código postal del domicilio
    LocID INT NOT NULL, -- Identificador de la localidad
    Colonia VARCHAR(100) NOT NULL, -- Colonia del domicilio
    DGPAID INT NOT NULL, -- Identificador de los datos generales del pescador o acuacultor
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (Locid) REFERENCES localidades(id), -- Llave foránea de la localidad con el identificador de la localidad-Locid
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id) -- Llave foránea de los datos generales pescador o acuacultor -DGPAid
);

CREATE TABLE telefonos_pa ( -- Tabla para los teléfonos de los pescadores o acuacultores físicas y morales
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador del teléfono
    Numero VARCHAR(10) NOT NULL, -- Numero del teléfono
    NumeroPrincipal BOOLEAN DEFAULT FALSE NOT NULL, -- Numero principal del teléfono  Verdadero para principal y Falso para secundario
    Tipo VARCHAR(20) NOT NULL, -- Tipo del teléfono para celular, fijo, etc.
    DGPAid INT NOT NULL, -- Identificador de los datos generales del pescador o acuacultor
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id) -- Llave foránea de los datos generales pescador o acuacultor -DGPAid
);

CREATE TABLE detalles_pa ( -- Tabla para los detalles de los pescadores o acuacultores físicas y morales
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, -- Identificador de los detalles del pescador o acuacultor
    DGPAid INT NOT NULL, -- Identificador de los datos generales del pescador o acuacultor
    IniOperaciones DATE NOT NULL, -- Fecha de inicio de operaciones
    ActvPesqueraAcuacultura BOOLEAN DEFAULT FALSE NOT NULL, -- Actividad pesquera Verdadero para Acuacultura
    ActvPesqueraCaptura BOOLEAN DEFAULT FALSE NOT NULL, -- Actividad pesquera Verdadero para Captura
    CantidadPescadores INT, -- Cantidad de pescadores o acuacultores
    DocActaNacimiento VARCHAR(255) NOT NULL, -- Documento de acta de nacimiento del pescador o acuacultor
    DocComprobanteDomicilio VARCHAR(255) NOT NULL, -- Documento de comprobante de domicilio del pescador o acuacultor
    DocCURP VARCHAR(255) NOT NULL, -- Documento de CURP del pescador o acuacultor
    DocIdentificacionOfc VARCHAR(255) NOT NULL, -- Documento de identificación oficial del pescador o acuacultor
    DocRFC VARCHAR(255) NOT NULL, -- Documento de RFC del pescador o acuacultor
    ActivoEmbMayor BOOLEAN DEFAULT FALSE NOT NULL, -- Activos, Verdadero para embarcación mayor
    ActivoEmbMenor BOOLEAN DEFAULT FALSE NOT NULL, -- Activos, Verdadero para embarcación menor
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id) -- Llave foránea de los datos generales pescador o acuacultor -DGPAid
);

CREATE TABLE sociodetalles_pa (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    CURP VARCHAR(18) NOT NULL,
    TipoPA BOOLEAN NOT NULL,
    DocActaNacimiento VARCHAR(255) NOT NULL,
    DocActaConstitutiva VARCHAR(255) NOT NULL,
    DocActaAsamblea VARCHAR(255) NOT NULL,
    DocComprobanteDomicilio VARCHAR(255) NOT NULL,
    DocCURP VARCHAR(255) NOT NULL,
    DocIdentificacionOfc VARCHAR(255) NOT NULL,
    DocRFC VARCHAR(255) NOT NULL,
    DocRepresentanteLegal VARCHAR(255) NOT NULL,
    DetallePAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DetallePAid) REFERENCES detalles_pa(id)
);

CREATE TABLE artes_pesca (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreArtePesca VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE especies (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEspecie VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreComun VARCHAR(50) NOT NULL,
    NombreCientifico VARCHAR(100) NOT NULL,
    TPEspecieid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id)
);

CREATE TABLE permisos_pesca (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombrePermiso VARCHAR(50) NOT NULL,
    TPEspecieid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id)
);

CREATE TABLE permisospesca_pa (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    FolioPermiso VARCHAR(50) UNIQUE NOT NULL,
    FechaExpedicion DATE NOT NULL,
    FechaVigencia DATE NOT NULL,
    EstatusPermiso BOOLEAN NOT NULL,
    Nota TEXT,
    TPPPescaid INT NOT NULL,
    DGPAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPPPescaid) REFERENCES permisos_pesca(id),
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id)
);

CREATE TABLE artes_pesca_permisos (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    PPPAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (PPPAid) REFERENCES permisospesca_pa(id),
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id)
);


CREATE TABLE unidadeconomica_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    RNPA VARCHAR(10),
    Nombre VARCHAR(50) NOT NULL,
    ActivoPropio BOOLEAN NOT NULL,
    UEDuenoid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (UEDuenoid) REFERENCES unidadeconomica_pa(id)
);

CREATE TABLE datosgenerales_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEmbMayor VARCHAR(50) NOT NULL,
    RNPA VARCHAR(10),
    Matricula VARCHAR(15) NOT NULL,
    PuertoBase VARCHAR(50) NOT NULL,
    DocAcreditacionLegalMotor VARCHAR(255) NOT NULL,
    DocCertificadoMatricula VARCHAR(255) NOT NULL,
    DocComprobanteTenenciaLegal VARCHAR(255) NOT NULL,
    DocCertificadoSegEmbs VARCHAR(255) NOT NULL,
    UEEMMAid INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (UEEMMAid) REFERENCES unidadeconomica_emb_ma(id)
);

CREATE TABLE embarcaciones_mayores_por_pa (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DGPAid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id),
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE tipos_actividad (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreTipoActividad VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tipos_cubierta (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreTipoCubierta VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE materiales_casco (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreMaterialCasco VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE equipos_deteccion (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEquipoDeteccion VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE sistemas_conservacion (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreSistemaConservacion VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE equipos_seguridad (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEquipoSeguridad VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE equipos_salvamento (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEquipoSalvamento VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE equipos_contraindencio (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEquipoContraIncendio VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE equipos_comunicacion (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEquipoComunicacion VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE equipos_navegacion (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEquipoNavegacion VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE caractrsgen_emb_ma(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    TPActid INT NOT NULL,
    TPCubid INT NOT NULL,
    CdPatrones INT NOT NULL,
    CdMotoristas INT NOT NULL,
    CdPescEspecializados INT NOT NULL,
    CdPescadores INT NOT NULL,
    AnioConstruccion INT NOT NULL,
    MtrlCascoid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPActid) REFERENCES tipos_actividad(id),
    FOREIGN KEY (TPCubid) REFERENCES tipos_cubierta(id),
    FOREIGN KEY (MtrlCascoid) REFERENCES materiales_casco(id),
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE artes_pesca_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id)
);

CREATE TABLE equipos_deteccion_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    EqpoDeteccionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoDeteccionid) REFERENCES equipos_deteccion(id)
);

CREATE TABLE sistemas_conservacion_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    SisConservacionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (SisConservacionid) REFERENCES sistemas_conservacion(id)
);

CREATE TABLE especies_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    TPEspecieid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id)
);

CREATE TABLE equipos_seguridad_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    EqpoSeguridadid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoSeguridadid) REFERENCES equipos_seguridad(id)
);

CREATE TABLE equipos_salvamento_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    EqpoSalvamentoid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoSalvamentoid) REFERENCES equipos_salvamento(id)
);

CREATE TABLE equipos_contraindencio_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    EqpoContraIncendioid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoContraIncendioid) REFERENCES equipos_contraindencio(id)
);

CREATE TABLE equipos_comunicacion_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    EqpoComunicacionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoComunicacionid) REFERENCES equipos_comunicacion(id)
);

CREATE TABLE equipos_navegacion_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    EqpoNavegacionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoNavegacionid) REFERENCES equipos_navegacion(id)
);

CREATE TABLE caractrsfis_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Eslora DECIMAL(10, 2) DEFAULT 0.00,
    Manga DECIMAL(10, 2) DEFAULT 0.00,
    Puntal DECIMAL(10, 2) DEFAULT 0.00,
    Calado DECIMAL(10, 2) DEFAULT 0.00,
    ArqueoNeto DECIMAL(10, 2) DEFAULT 0.00,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE motores_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Marca VARCHAR(20) NOT NULL,
    Modelo VARCHAR(10) NOT NULL,
    Serie VARCHAR(10) NOT NULL,
    Potencia DECIMAL(10, 2) DEFAULT 0.00,
    MtrPrincipal BOOLEAN NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE motores_por_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DGEMMAid INT NOT NULL,
    MtrEmbMaid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (MtrEmbMaid) REFERENCES motores_emb_ma(id)
);

CREATE TABLE artes_equipo_pesca_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    TPEspecieid INT NOT NULL,
    Cantidad INT NOT NULL,
    Longitud DECIMAL(10, 2) DEFAULT 0.00,
    Altura DECIMAL(10, 2) DEFAULT 0.00,
    Malla DECIMAL(10, 2) DEFAULT 0.00,
    Material VARCHAR(50) DEFAULT 0.00,
    Reinales DECIMAL(10, 2) DEFAULT 0.00,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id),
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id),
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE docs_regtr_artespesca_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DocFacturaElectronica VARCHAR(255) NOT NULL,
    DocNotaRemision VARCHAR(255) NOT NULL,
    DocFacturaEndosada VARCHAR(255) NOT NULL,
    DocTestimonial VARCHAR(255) NOT NULL,
    ArteEquipoPescaEmbMaid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ArteEquipoPescaEmbMaid) REFERENCES artes_equipo_pesca_emb_ma(id)
);

CREATE TABLE artes_equipo_pesca_por_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ArteEquipoPescaEmbMaid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (ArteEquipoPescaEmbMaid) REFERENCES artes_equipo_pesca_emb_ma(id)
);

CREATE TABLE costos_operaciones_emb_ma (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    Combustible DECIMAL(10, 2) DEFAULT 0.00,
    Lubricantes DECIMAL(10, 2) DEFAULT 0.00,
    Mantenimiento DECIMAL(10, 2) DEFAULT 0.00,
    Salarios DECIMAL(10, 2) DEFAULT 0.00,
    Seguros DECIMAL(10, 2) DEFAULT 0.00,
    Permisos DECIMAL(10, 2) DEFAULT 0.00,
    Impuestos DECIMAL(10, 2) DEFAULT 0.00,
    Avituallamiento DECIMAL(10, 2) DEFAULT 0.00,
    Preoperativos DECIMAL(10, 2) DEFAULT 0.00,
    AsistenciaTecnica DECIMAL(10, 2) DEFAULT 0.00,
    Administrativos DECIMAL(10, 2) DEFAULT 0.00,
    Otros DECIMAL(10, 2) DEFAULT 0.00,
    Total DECIMAL(10, 2) DEFAULT 0.00 NOT NULL,
    DGEMMAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);


CREATE TABLE unidadeconomica_emb_me(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    RNPA VARCHAR(10),
    Nombre VARCHAR(100) NOT NULL,
    UEDueno INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (UEDueno) REFERENCES unidadeconomica_pa(id)
);

CREATE TABLE datosgenerales_emb_me (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreEmbarcacion VARCHAR(100) NOT NULL,
    RNPA VARCHAR(10),
    Matricula VARCHAR(12) NOT NULL,
    TPActid INT NOT NULL,
    MtrlCascoid INT NOT NULL,
    CapacidadCarga DECIMAL(10, 2) DEFAULT 0.00,
    MedidaEslora DECIMAL(10, 2) DEFAULT 0.00,
    DocAcreditacionLegalMotor VARCHAR(255) NOT NULL,
    DocCertificadoMatricula VARCHAR(255) NOT NULL,
    DocTenenciaLegal VARCHAR(255) NOT NULL,
    DocCertificadoSeguridad VARCHAR(255) NOT NULL,
    UEEMMEid INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (UEEMMEid) REFERENCES unidadeconomica_emb_me(id),
    FOREIGN KEY (TPActid) REFERENCES tipos_actividad(id),
    FOREIGN KEY (MtrlCascoid) REFERENCES materiales_casco(id)
);

CREATE TABLE embarcaciones_menores_por_pa (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DGPAid INT NOT NULL,
    DGEMMEid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id),
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id)
);

CREATE TABLE tipos_motor (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreTipoMotor VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE motores_emb_me (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    TPMotorid INT NOT NULL,
    Marca VARCHAR(20) NOT NULL,
    Potencia DECIMAL(10, 2) DEFAULT 0.00,
    Serie VARCHAR(20) NOT NULL,
    Combustible VARCHAR(20) NOT NULL,
    DGEMMEid INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id),
    FOREIGN KEY (TPMotorid) REFERENCES tipos_motor(id)
);

CREATE TABLE motores_por_emb_me (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DGEMMEid INT NOT NULL,
    MtrEmbMeid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id),
    FOREIGN KEY (MtrEmbMeid) REFERENCES motores_emb_me(id)
);

CREATE TABLE artes_equipo_pesca_emb_me (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    TPEspecieid INT NOT NULL,
    Cantidad INT NOT NULL,
    Longitud DECIMAL(10, 2) DEFAULT 0.00,
    Altura DECIMAL(10, 2) DEFAULT 0.00,
    Malla DECIMAL(10, 2) DEFAULT 0.00,
    Material VARCHAR(50) NOT NULL,
    Reinales DECIMAL(10, 2) DEFAULT 0.00,
    DGEMMEid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id),
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id),
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id)
);

CREATE TABLE docs_regtr_artespesca_emb_me (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DocFacturaElectronica VARCHAR(255) NOT NULL,
    DocNotaRemision VARCHAR(255) NOT NULL,
    DocFacturaEndosada VARCHAR(255) NOT NULL,
    DocTestimonial VARCHAR(255) NOT NULL,
    ArteEquipoPescaEmbMeid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ArteEquipoPescaEmbMeid) REFERENCES artes_equipo_pesca_emb_me(id)
);

CREATE TABLE artes_equipo_pesca_por_emb_me (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DGEMMEid INT NOT NULL,
    ArteEquipoPescaEmbMeid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ArteEquipoPescaEmbMeid) REFERENCES artes_equipo_pesca_emb_me(id),
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id)
);


CREATE TABLE unidadeconomica_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    RNPA VARCHAR(10),
    Nombre VARCHAR(100) NOT NULL,
    Cambio BOOLEAN DEFAULT FALSE,
    Arrendado BOOLEAN DEFAULT FALSE,
    UEDueno INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (UEDueno) REFERENCES unidadeconomica_pa(id)
);

CREATE TABLE datosgenerales_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreInstalacion VARCHAR(50) NOT NULL,
    RNPA VARCHAR(10),
    Ubicacion VARCHAR(100) NOT NULL,
    Acceso TEXT NOT NULL,
    Locid INT NOT NULL,
    UEIAid INT,
    DocActaCreacion VARCHAR(255) NOT NULL,
    DocPlanoInstalaciones VARCHAR(255) NOT NULL,
    DocAcreditacionLegalInstalacion VARCHAR(255) NOT NULL,
    DocComprobanteDomicilio VARCHAR(255) NOT NULL,
    DocEspeTecnicasFisicas VARCHAR(255) NOT NULL,
    DocMapaLocalizacion VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (Locid) REFERENCES localidades(id),
    FOREIGN KEY (UEIAid) REFERENCES unidadeconomica_ia(id)
);

CREATE TABLE datostecnicos_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    UsoComercial BOOLEAN DEFAULT FALSE,
    UsoDidacta BOOLEAN DEFAULT FALSE,
    UsoFomento BOOLEAN DEFAULT FALSE,
    UsoInvestigacion BOOLEAN DEFAULT FALSE,
    UsoRecreativo BOOLEAN DEFAULT FALSE,
    UsoOtro TEXT,
    TipoLaboratorio BOOLEAN DEFAULT FALSE,
    TipoGranja BOOLEAN DEFAULT FALSE,
    TipoCentroAcuicola BOOLEAN DEFAULT FALSE,
    TipoOtro TEXT,
    ModeloIntensivo BOOLEAN DEFAULT FALSE,
    ModeloSemiintensivo BOOLEAN DEFAULT FALSE,
    ModeloExtensivo BOOLEAN DEFAULT FALSE,
    ModeloHiperintensivo BOOLEAN DEFAULT FALSE,
    ModeloOtro TEXT,
    AreaTotal DECIMAL(10, 2) DEFAULT 0.00,
    AreaAcuicola DECIMAL(10, 2) DEFAULT 0.00,
    AreaRestante TEXT,
    DGIAid INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);

CREATE TABLE especies_objetivo (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    CpProduccionMiles INT NOT NULL,
    CpProduccionToneladas DECIMAL(10, 2) NOT NULL DEFAULT 0,
    TPEspeciesid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPEspeciesid) REFERENCES especies(id)
);

CREATE TABLE especies_objetivo_por_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DTIAid INT NOT NULL,
    EspecieOid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DTIAid) REFERENCES datostecnicos_ia(id),
    FOREIGN KEY (EspecieOid) REFERENCES especies_objetivo(id)
);

CREATE TABLE tipos_activo (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreActivo VARCHAR(100) UNIQUE NOT NULL,
    Clave VARCHAR(6) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE activos_produccion_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DGIAid INT,
    TPActivoid INT NOT NULL,
    Cantidad INT NOT NULL,
    Largo DECIMAL(10, 2) DEFAULT 0.00,
    Ancho DECIMAL(10, 2) DEFAULT 0.00,
    Altura DECIMAL(10, 2) DEFAULT 0.00,
    Capacidad DECIMAL(10, 2) DEFAULT 0.00,
    UnidadMedida ENUM (
        'METRO CUADRADO',
        'METRO CUBICO',
        'KILOGRAMO',
        'LITRO',
        'PIEZA'
    ) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id),
    FOREIGN KEY (TPActivoid) REFERENCES tipos_activo(id)
);

CREATE TABLE activos_produccion_por_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    DGIAid INT NOT NULL,
    APIAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id),
    FOREIGN KEY (APIAid) REFERENCES activos_produccion_ia(id)
);
CREATE TABLE fuentes_agua_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    FTPozoProfundo BOOLEAN DEFAULT FALSE,
    FTPozoCieloAbierto BOOLEAN DEFAULT FALSE,
    FTRio BOOLEAN DEFAULT FALSE,
    FTLago BOOLEAN DEFAULT FALSE,
    FTArroyo BOOLEAN DEFAULT FALSE,
    FTPresa BOOLEAN DEFAULT FALSE,
    FTMar BOOLEAN DEFAULT FALSE,
    FTOtro TEXT,
    FlujoAguaLxM DECIMAL(10, 2) DEFAULT 0.00,
    DGIAid INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);
CREATE TABLE administracion_trabajadores_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NumFamilias INT,
    NumMujeres INT,
    NumHombres INT,
    Integ15Menos INT,
    Integ16a25 INT,
    Integ26a35 INT,
    Integ36a45 INT,
    Integ46a60 INT,
    IntegMas60 INT,
    RequiereCont BOOLEAN DEFAULT FALSE,
    Temporales INT,
    Permanentes INT,
    TotalIntegrantes INT NOT NULL,
    DGIAid INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);
CREATE TABLE administracion_trabajadores_por_ia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    ATIAid INT NOT NULL,
    DGIAid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ATIAid) REFERENCES administracion_trabajadores_ia(id),
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);

CREATE TABLE tipos_modalidad (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreModalidad VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE tipos_proceso (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreProceso VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE tipos_solicitud (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    NombreSolicitud VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    FolioSolicitud VARCHAR(13) UNIQUE NOT NULL,
    FechaSolicitud DATE NOT NULL,
    TPProcesoid INT NOT NULL,
    TPModalidadid INT NOT NULL,
    TPSolicitudid INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (TPProcesoid) REFERENCES tipos_proceso(id),
    FOREIGN KEY (TPModalidadid) REFERENCES tipos_modalidad(id),
    FOREIGN KEY (TPSolicitudid) REFERENCES tipos_solicitud(id)
);

---- Vistas ----

CREATE VIEW vista_solicitudes AS
SELECT
    solicitudes.FolioSolicitud AS "Folio de la solicitud",
    solicitudes.FechaSolicitud AS "Fecha de la solicitud",
    tipos_proceso.NombreProceso AS "Proceso de la solicitud",
    tipos_modalidad.NombreModalidad AS "Modalidad de la solicitud",
    tipos_solicitud.NombreSolicitud AS "Tipo de la solicitud"
FROM solicitudes
INNER JOIN tipos_proceso ON solicitudes.TPProcesoid = tipos_proceso.id
INNER JOIN tipos_modalidad ON solicitudes.TPModalidadid = tipos_modalidad.id
INNER JOIN tipos_solicitud ON solicitudes.TPSolicitudid = tipos_solicitud.id;


---- Indices ----

CREATE INDEX idx_NombreRol ON roles(NombreRol); -- Indice para el nombre del rol

CREATE INDEX idx_Curp ON users(CURP); -- Indice para la curp del usuario
CREATE INDEX idx_Email ON users(Email); -- Indice para la curp del usuario
CREATE INDEX idx_Rolid ON users(Rolid); -- Indice para el rol del usuario
