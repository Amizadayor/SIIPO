DROP DATABASE IF EXISTS conapesca;
CREATE DATABASE conapesca;
USE conapesca;

CREATE TABLE roles (
    id INT PRIMARY KEY NOT NULL,
    NombreRol VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE users (
    id INT PRIMARY KEY NOT NULL,
    Nombre VARCHAR(30) NOT NULL,
    CURP VARCHAR(18) NOT NULL,
    Email VARCHAR(30),
    Password VARCHAR(20) NOT NULL,
    Rolid INT NOT NULL,
    FOREIGN KEY (Rolid) REFERENCES roles(id)
);

CREATE TABLE privilegios (
    id INT PRIMARY KEY NOT NULL,
    NombrePermiso VARCHAR(30) UNIQUE NOT NULL
);

CREATE TABLE asignacion_permisos (
    id INT PRIMARY KEY NOT NULL,
    Rolid INT NOT NULL,
    Privid INT NOT NULL,
    Permitido BOOLEAN NOT NULL,
    FOREIGN KEY (Rolid) REFERENCES roles(id),
    FOREIGN KEY (Privid) REFERENCES privilegios(id)
);

CREATE TABLE regiones (
    id INT PRIMARY KEY NOT NULL,
    NombreRegion VARCHAR(40) NOT NULL
);

CREATE TABLE distritos (
    id INT PRIMARY KEY NOT NULL,
    NombreDistrito VARCHAR(30) NOT NULL,
    Regid INT NOT NULL,
    FOREIGN KEY (Regid) REFERENCES regiones(id)
);

CREATE TABLE municipios (
    id INT PRIMARY KEY NOT NULL,
    NombreMunicipio VARCHAR(30) NOT NULL,
    Disid INT NOT NULL,
    FOREIGN KEY (Disid) REFERENCES distritos(id)
);

CREATE TABLE localidades (
    id INT PRIMARY KEY NOT NULL,
    NombreLocalidad VARCHAR(30) NOT NULL,
    Munid INT NOT NULL,
    FOREIGN KEY (Munid) REFERENCES municipios(id)
);

CREATE TABLE oficinas (
    id INT PRIMARY KEY NOT NULL,
    NombreOficina VARCHAR(50) NOT NULL,
    Ubicacion VARCHAR(100) NOT NULL,
    Telefono VARCHAR(10) NOT NULL,
    Email VARCHAR(40) NOT NULL
);



CREATE TABLE unidadeconomica_pa (
    id INT PRIMARY KEY NOT NULL,
    Ofcid INT NOT NULL,
    FechaRegistro DATE NOT NULL,
    RNPA VARCHAR(50),
    FOREIGN KEY (Ofcid) REFERENCES oficinas(id)
);

CREATE TABLE datosgenerales_pa (
    id INT PRIMARY KEY NOT NULL,
    TipoPersona BOOLEAN NOT NULL,
    CURP VARCHAR(18) NOT NULL,
    RFC VARCHAR(13),
    Nombres VARCHAR(50) NOT NULL,
    ApPaterno VARCHAR(30) NOT NULL,
    ApMaterno VARCHAR(30) NOT NULL,
    FechaNacimiento DATE NOT NULL,
    Sexo ENUM ('M', 'F') NOT NULL,
    GrupoSanguineo VARCHAR(4),
    Email VARCHAR(40),
    UEPAid INT NOT NULL,
    FOREIGN KEY (UEPAid) REFERENCES unidadeconomica_pa(id)
);

CREATE TABLE domicilio_pa (
    id INT PRIMARY KEY NOT NULL,
    Calle VARCHAR(100) NOT NULL,
    NmExterior VARCHAR(6) NOT NULL,
    NmInterior VARCHAR(6) NOT NULL,
    CodigoPostal VARCHAR(10),
    LocID INT NOT NULL,
    Colonia VARCHAR(100) NOT NULL,
    TipoTelefono VARCHAR(20) NOT NULL,
    DGPAID INT NOT NULL,
    FOREIGN KEY (Locid) REFERENCES localidades(id),
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id)
);

CREATE TABLE telefonos_pa (
    id INT PRIMARY KEY NOT NULL,
    Numero VARCHAR(10) NOT NULL,
    Tipo VARCHAR(20) NOT NULL,
    DGPAid INT NOT NULL,
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id)
);

CREATE TABLE permisos_pesca (
    id INT PRIMARY KEY NOT NULL,
    NombrePermiso VARCHAR(50) NOT NULL
);

CREATE TABLE artes_pesca (
    id INT PRIMARY KEY NOT NULL,
    NombreArtePesca VARCHAR(50) NOT NULL
);

CREATE TABLE especies (
    id INT PRIMARY KEY NOT NULL,
    NombreEspecie VARCHAR(50) NOT NULL
);

CREATE TABLE peces (
    id INT PRIMARY KEY NOT NULL,
    NombreComun VARCHAR(50) NOT NULL,
    NombreCientifico VARCHAR(100) NOT NULL,
    TPEspecieid INT NOT NULL,
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id)
);

CREATE TABLE detalles_pa (
    id INT PRIMARY KEY NOT NULL,
    DGPAid INT NOT NULL,
    IniOperaciones DATE NOT NULL,
    ActvPesqueraAcuacultura BOOLEAN NOT NULL,
    ActvPesqueraCaptura BOOLEAN NOT NULL,
    ActivoEmbMayor BOOLEAN NOT NULL,
    ActivoEmbMenor BOOLEAN NOT NULL,
    DocActaNacimiento BLOB NOT NULL,
    DocComprobanteDomicilio BLOB NOT NULL,
    DocCURP BLOB NOT NULL,
    DocIdentificacionOfc BLOB NOT NULL,
    DocRFC BLOB NOT NULL,
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id)
);

CREATE TABLE permisospesca_pa (
    id INT PRIMARY KEY NOT NULL,
    FolioPermiso VARCHAR(50) NOT NULL,
    FechaExpedicion DATE NOT NULL,
    FechaVigencia DATE NOT NULL,
    EstatusPermiso BOOLEAN NOT NULL,
    Nota TEXT,
    TPPPescaid INT NOT NULL,
    DetallePAid INT NOT NULL,
    DGPAid INT NOT NULL,
    FOREIGN KEY (TPPPescaid) REFERENCES permisos_pesca(id),
    FOREIGN KEY (DetallePAid) REFERENCES detalles_pa(id),
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id)
);

CREATE TABLE ArtePescaPermiso (
    id INT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    PPPAid INT NOT NULL,
    FOREIGN KEY (PPPAid) REFERENCES permisospesca_pa(id),
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id)
);

CREATE TABLE sociodetalles_pa (
    id INT PRIMARY KEY NOT NULL,
    IniOperaciones DATE NOT NULL,
    ActvPesquera BOOLEAN NOT NULL,
    CantidadPescadores INT,
    CURP VARCHAR(18) NOT NULL,
    TipoPA BOOLEAN NOT NULL,
    DocActaNacimiento BLOB NOT NULL,
    DocActaConstitutiva BLOB NOT NULL,
    DocActaAsamblea BLOB NOT NULL,
    DocComprobanteDomicilio BLOB NOT NULL,
    DocCURP BLOB NOT NULL,
    DocIdentificacionOfc BLOB NOT NULL,
    DocRFC BLOB NOT NULL,
    DocAcreditacionRepresentanteLegal BLOB NOT NULL,
    DetallePAid INT NOT NULL,
    FOREIGN KEY (DetallePAid) REFERENCES detalles_pa(id)
);



CREATE TABLE unidadeconomica_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    RNPA VARCHAR(50),
    Nombre VARCHAR(50) NOT NULL,
    ActivoPropio BOOLEAN NOT NULL,
    UEDuenoid INT NOT NULL,
    FOREIGN KEY (UEDuenoid) REFERENCES unidadeconomica_pa(id)
);

CREATE TABLE datosgenerales_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    NombreEmbMayor VARCHAR(50) NOT NULL,
    RNPA VARCHAR(50),
    Matricula VARCHAR(50) NOT NULL,
    PuertoBase VARCHAR(50) NOT NULL,
    DocAcreditacionLegalMotor BLOB NOT NULL,
    DocCertificadoMatricula BLOB NOT NULL,
    DocComprobanteTenenciaLegal BLOB NOT NULL,
    DocCertificadoSegEmbs BLOB NOT NULL,
    UEEMMAid INT,
    FOREIGN KEY (UEEMMAid) REFERENCES unidadeconomica_emb_ma(id)
);

CREATE TABLE embarcacionesmayores_pa (
    id INT PRIMARY KEY NOT NULL,
    DGPAid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGPAid) REFERENCES datosgenerales_pa(id),
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE tipos_actividad (
    id INT PRIMARY KEY NOT NULL,
    NombreTipoActividad VARCHAR(50) NOT NULL
);

CREATE TABLE tipos_cubierta (
    id INT PRIMARY KEY NOT NULL,
    NombreTipoCubierta VARCHAR(50) NOT NULL
);

CREATE TABLE materiales_casco (
    id INT PRIMARY KEY NOT NULL,
    NombreMaterialCasco VARCHAR(50) NOT NULL
);

CREATE TABLE equipos_deteccion (
    id INT PRIMARY KEY NOT NULL,
    NombreEquipoDeteccion VARCHAR(50)
);

CREATE TABLE sistemas_conservacion (
    id INT PRIMARY KEY NOT NULL,
    NombreSistemaConservacion VARCHAR(50) NOT NULL
);

CREATE TABLE equipos_seguridad (
    id INT PRIMARY KEY NOT NULL,
    NombreEquipoSeguridad VARCHAR(50) NOT NULL
);

CREATE TABLE equipos_salvamento (
    id INT PRIMARY KEY NOT NULL,
    NombreEquipoSalvamento VARCHAR(50) NOT NULL
);

CREATE TABLE equipos_contraindencio (
    id INT PRIMARY KEY NOT NULL,
    NombreEquipoContraIncendio VARCHAR(50) NOT NULL
);

CREATE TABLE equipos_comunicacion (
    id INT PRIMARY KEY NOT NULL,
    NombreEquipoComunicacion VARCHAR(50) NOT NULL
);

CREATE TABLE equipos_navegacion (
    id INT PRIMARY KEY NOT NULL,
    NombreEquipoNavegacion VARCHAR(50) NOT NULL
);

CREATE TABLE caractrsgen_emb_ma(
    id INT PRIMARY KEY NOT NULL,
    TPActid INT NOT NULL,
    TPCubid INT NOT NULL,
    CdPatrones INT NOT NULL,
    CdMotoristas INT NOT NULL,
    CdPSEspecializados INT NOT NULL,
    CdPescadores INT NOT NULL,
    AnioConstruccion INT NOT NULL,
    MtrlCascoid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (TPActid) REFERENCES tipos_actividad(id),
    FOREIGN KEY (TPCubid) REFERENCES tipos_cubierta(id),
    FOREIGN KEY (MtrlCascoid) REFERENCES materiales_casco(id),
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE artes_pesca_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id)
);

CREATE TABLE equipos_deteccion_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    EqpoDeteccionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoDeteccionid) REFERENCES equipos_deteccion(id)
);

CREATE TABLE sistemas_conservacion_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    SisConservacionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (SisConservacionid) REFERENCES sistemas_conservacion(id)
);

CREATE TABLE especies_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    TPEspecieid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id)
);

CREATE TABLE equipos_seguridad_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    EqpoSeguridadid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoSeguridadid) REFERENCES equipos_seguridad(id)
);

CREATE TABLE equipos_salvamento_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    EqpoSalvamentoid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoSalvamentoid) REFERENCES equipos_salvamento(id)
);
CREATE TABLE equipos_contraindencio_emb_mas (
    id INT PRIMARY KEY NOT NULL,
    EqpoContraIncendioid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoContraIncendioid) REFERENCES equipos_contraindencio(id)
);
CREATE TABLE equipos_comunicacion_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    EqpoComunicacionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoComunicacionid) REFERENCES equipos_comunicacion(id)
);
CREATE TABLE equipos_navegacion_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    EqpoNavegacionid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (EqpoNavegacionid) REFERENCES equipos_navegacion(id)
);

CREATE TABLE caractrsfis_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    Eslora DECIMAL(10, 2) DEFAULT 0.00,
    Manga DECIMAL(10, 2) DEFAULT 0.00,
    Puntal DECIMAL(10, 2) DEFAULT 0.00,
    Calado DECIMAL(10, 2) DEFAULT 0.00,
    ArqueoNeto DECIMAL(10, 2) DEFAULT 0.00,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE motores_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    Marca VARCHAR(50) NOT NULL,
    Modelo VARCHAR(50) NOT NULL,
    Serie VARCHAR(50) NOT NULL,
    Potencia DECIMAL(10, 2) DEFAULT 0.00,
    MtrPrincipal BOOLEAN NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);
CREATE TABLE motores_por_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    DGEMMAid INT NOT NULL,
    MtrEmbMaid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (MtrEmbMaid) REFERENCES motores_emb_ma(id)
);
CREATE TABLE artes_equipo_pesca_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    TPEspecieid INT NOT NULL,
    Cantidad INT NOT NULL,
    Longitud DECIMAL(10, 2) DEFAULT 0.00,
    Altura DECIMAL(10, 2) DEFAULT 0.00,
    Malla DECIMAL(10, 2) DEFAULT 0.00,
    Material VARCHAR(50) DEFAULT 0.00,
    Reinales DECIMAL(10, 2) DEFAULT 0.00,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id),
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id),
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);

CREATE TABLE docs_regtr_artespesca_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    DocFacturaElectronica BLOB NOT NULL,
    DocNotaRemision BLOB NOT NULL,
    DocFacturaEndosada BLOB NOT NULL,
    DocTestimonial BLOB NOT NULL,
    DocArteEquipoPescaEmMaID INT NOT NULL,
    ArteEquipoPescaEmbMaID INT NOT NULL,
    FOREIGN KEY (ArteEquipoPescaEmbMaid) REFERENCES artes_equipo_pesca_emb_ma(id)
);

CREATE TABLE artes_equipo_pesca_por_emb_ma (
    id INT PRIMARY KEY NOT NULL,
    ArteEquipoPescaEmbMaid INT NOT NULL,
    DGEMMAid INT NOT NULL,
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id),
    FOREIGN KEY (ArteEquipoPescaEmbMaid) REFERENCES artes_equipo_pesca_emb_ma(id)
);

CREATE TABLE costos_operacion_emb_ma (
    id INT PRIMARY KEY NOT NULL,
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
    FOREIGN KEY (DGEMMAid) REFERENCES datosgenerales_emb_ma(id)
);



CREATE TABLE unidadeconomica_emb_me(
    id INT PRIMARY KEY NOT NULL,
    RNPA VARCHAR(50),
    Nombre VARCHAR(100) NOT NULL,
    UEDueno INT NOT NULL,
    FOREIGN KEY (UEDueno) REFERENCES unidadeconomica_pa(id)
);

CREATE TABLE datosgenerales_emb_me (
    id INT PRIMARY KEY NOT NULL,
    NombreEmbarcacion VARCHAR(100) NOT NULL,
    RNPA VARCHAR(50),
    Matricula VARCHAR(50) NOT NULL,
    TPActid INT NOT NULL,
    MtrlCascoid INT NOT NULL,
    CapacidadCarga DECIMAL(10, 2) DEFAULT 0.00,
    MedidaEslora DECIMAL(10, 2) DEFAULT 0.00,
    AcreditacionLegalMotor BLOB,
    CertificadoMatricula BLOB,
    ComprobanteTenenciaLegal BLOB,
    CertificadoSeguridadEmbarcaciones BLOB,
    UEEMMEid INT,
    FOREIGN KEY (UEEMMEid) REFERENCES unidadeconomica_emb_me(id),
    FOREIGN KEY (TPActid) REFERENCES tipos_actividad(id),
    FOREIGN KEY (MtrlCascoid) REFERENCES materiales_casco(id)
);

CREATE TABLE tipos_motor (
    id INT PRIMARY KEY NOT NULL,
    NombreTipoMotor VARCHAR(50) NOT NULL
);

CREATE TABLE motores_emb_me (
    id INT PRIMARY KEY NOT NULL,
    TPMotorid INT NOT NULL,
    Marca VARCHAR(20) NOT NULL,
    Potencia DECIMAL(10, 2) DEFAULT 0.00,
    Serie VARCHAR(20) NOT NULL,
    Combustible VARCHAR(20) NOT NULL,
    DGEMMEid INT,
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id),
    FOREIGN KEY (TPMotorid) REFERENCES tipos_motor(id)
);

CREATE TABLE motores_por_emb_me (
    id INT PRIMARY KEY NOT NULL,
    DGEMMEid INT NOT NULL,
    MtrEmbMeid INT NOT NULL,
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id),
    FOREIGN KEY (MtrEmbMeid) REFERENCES motores_emb_me(id)
);

CREATE TABLE artes_equipo_pesca_emb_me  (
    id INT PRIMARY KEY NOT NULL,
    TPArtPescaid INT NOT NULL,
    TPEspecieid INT NOT NULL,
    Cantidad INT NOT NULL,
    Longitud DECIMAL(10, 2) DEFAULT 0.00,
    Altura DECIMAL(10, 2) DEFAULT 0.00,
    Malla DECIMAL(10, 2) DEFAULT 0.00,
    Material VARCHAR(50) NOT NULL,
    Reinales DECIMAL(10, 2) DEFAULT 0.00,
    DGEMMEid INT NOT NULL,
    FOREIGN KEY (TPArtPescaid) REFERENCES artes_pesca(id),
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id),
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id)
);

CREATE TABLE docs_regtr_artespesca_emb_me (
    id INT PRIMARY KEY NOT NULL,
    DocFacturaElectronica BLOB NOT NULL,
    DocNotaRemision BLOB NOT NULL,
    DocFacturaEndosada BLOB NOT NULL,
    DocTestimonial BLOB NOT NULL,
    DocArteEquipoPescaEmMaID INT NOT NULL,
    ArteEquipoPescaEmbMeid INT NOT NULL,
    FOREIGN KEY (ArteEquipoPescaEmbMeid) REFERENCES artes_equipo_pesca_emb_me(id)
);

CREATE TABLE artes_equipo_pesca_por_emb_me (
    id INT PRIMARY KEY NOT NULL,
    DGEMMEid INT NOT NULL,
    ArteEquipoPescaEmbMeid INT NOT NULL,
    FOREIGN KEY (ArteEquipoPescaEmbMeid) REFERENCES artes_equipo_pesca_emb_me(id),
    FOREIGN KEY (DGEMMEid) REFERENCES datosgenerales_emb_me(id)
);



CREATE TABLE unidadeconomica_ia (
    id INT PRIMARY KEY NOT NULL,
    RNPA VARCHAR(50),
    Nombre VARCHAR(100) NOT NULL,
    PropietarioArrendamiento BOOLEAN NOT NULL,
    UEDueno INT NOT NULL,
    FOREIGN KEY (UEDueno) REFERENCES unidadeconomica_pa(id)
);

CREATE TABLE datosgenerales_ia (
    id INT PRIMARY KEY NOT NULL,
    NombreInstalacion VARCHAR(50) NOT NULL,
    RNPA VARCHAR(50),
    Ubicacion VARCHAR(100) NOT NULL,
    Acceso TEXT NOT NULL,
    Locid INT NOT NULL,
    UEIAid INT,
    DocActaCreacion BLOB NOT NULL,
    DocPlanoInstalaciones BLOB NOT NULL,
    DocAcreditacionLegalInstalacion BLOB NOT NULL,
    DocComprobanteDomicilio BLOB NOT NULL,
    DocEspeTecnicasFisicas BLOB NOT NULL,
    DocMapaLocalizacion BLOB NOT NULL,
    FOREIGN KEY (Locid) REFERENCES localidades(id),
    FOREIGN KEY (UEIAid) REFERENCES unidadeconomica_ia(id)
);

CREATE TABLE datostecnicos_ia (
    id INT PRIMARY KEY NOT NULL,
    UsoComercial BOOLEAN,
    UsoDidacta BOOLEAN,
    UsoFomento BOOLEAN,
    UsoInvestigacion BOOLEAN,
    UsoRecreativo BOOLEAN,
    UsoOtro TEXT,
    TipoLaboratorio BOOLEAN,
    TipoGranja BOOLEAN,
    TipoCentroAcuicola BOOLEAN,
    TipoOtro TEXT,
    ModeloIntensivo BOOLEAN,
    ModeloSemiintensivo BOOLEAN,
    ModeloExtensivo BOOLEAN,
    ModeloHiperintensivo BOOLEAN,
    ModeloOtro TEXT,
    AreaTotal DECIMAL(10, 2) DEFAULT 0.00,
    AreaAcuicola DECIMAL(10, 2) DEFAULT 0.00,
    AreaRestante TEXT,
    CapacidadProduccionMiles INT,
    CapacidadProduccionToneladas DECIMAL(10, 2) DEFAULT 0.00,
    DGIAid INT,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);

CREATE TABLE especies_objetivo (
    id INT PRIMARY KEY NOT NULL,
    NombreComun VARCHAR(50) NOT NULL,
    NombreCientifico VARCHAR(100) NOT NULL,
    TPEspecieid INT NOT NULL,
    FOREIGN KEY (TPEspecieid) REFERENCES especies(id)
);

CREATE TABLE especies_objetivo_ia (
    id INT PRIMARY KEY NOT NULL,
    DTIAid INT NOT NULL,
    EspecieOid INT NOT NULL,
    FOREIGN KEY (DTIAid) REFERENCES datostecnicos_ia(id),
    FOREIGN KEY (EspecieOid) REFERENCES especies_objetivo(id)
);

CREATE TABLE tipos_activo (
    id INT PRIMARY KEY NOT NULL,
    NombreActivo VARCHAR(100) NOT NULL
);

CREATE TABLE activos_produccion_ia (
    id INT PRIMARY KEY NOT NULL,
    DGIAid INT,
    TPActivoid INT NOT NULL,
    Clave VARCHAR(50) NOT NULL,
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
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id),
    FOREIGN KEY (TPActivoid) REFERENCES tipos_activo(id)
);

CREATE TABLE fuentes_agua_ia (
    id INT PRIMARY KEY NOT NULL,
    FTPozoProfundo BOOLEAN,
    FTPozoCieloAbierto BOOLEAN,
    FTRio BOOLEAN,
    FTLago BOOLEAN,
    FTArroyo BOOLEAN,
    FTPresa BOOLEAN,
    FTMar BOOLEAN,
    FTOtro TEXT,
    FlujoAguaLxM DECIMAL(10, 2) DEFAULT 0.00,
    DGIAid INT,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);

CREATE TABLE activos_produccion_por_ia (
    id INT PRIMARY KEY NOT NULL,
    DGIAid INT NOT NULL,
    APIAid INT NOT NULL,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id),
    FOREIGN KEY (APIAid) REFERENCES activos_produccion_ia(id)
);

CREATE TABLE administracion_trabajadores_ia (
    id INT PRIMARY KEY NOT NULL,
    NumFamilias INT,
    NumMujeres INT,
    NumHombres INT,
    Integ15Menos INT,
    Integ16a25 INT,
    Integ26a35 INT,
    Integ36a45 INT,
    Integ46a60 INT,
    IntegMas60 INT,
    RequiereCont BOOLEAN,
    Temporales INT,
    Permanentes INT,
    TotalIntegrantes INT NOT NULL,
    DGIAid INT,
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);

CREATE TABLE administracion_trabajadores_por_ia  (
    id INT PRIMARY KEY NOT NULL,
    ATIAid INT NOT NULL,
    DGIAid INT NOT NULL,
    FOREIGN KEY (ATIAid) REFERENCES administracion_trabajadores_ia(id),
    FOREIGN KEY (DGIAid) REFERENCES datosgenerales_ia(id)
);

CREATE TABLE tipos_modalidad (
    id INT PRIMARY KEY NOT NULL,
    NombreModalidad VARCHAR(30) NOT NULL
);

CREATE TABLE tipos_proceso (
    id INT PRIMARY KEY NOT NULL,
    NombreProceso VARCHAR(30) NOT NULL
);

CREATE TABLE tipos_solicitud (
    id INT PRIMARY KEY NOT NULL,
    NombreSolicitud VARCHAR(30) NOT NULL
);

CREATE TABLE solicitudes_detalles (
    id INT PRIMARY KEY NOT NULL,
    FolioSolicitud VARCHAR(13) NOT NULL,
    FechaSolicitud DATE,
    TPProcesoid INT NOT NULL,
    TPModalidadid INT NOT NULL,
    TPSolicitudid INT NOT NULL,
    FOREIGN KEY (TPProcesoid) REFERENCES tipos_proceso(id),
    FOREIGN KEY (TPModalidadid) REFERENCES tipos_modalidad(id),
    FOREIGN KEY (TPSolicitudid) REFERENCES tipos_solicitud(id)
);
