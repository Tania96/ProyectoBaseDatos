CREATE TABLE USUARIO (
id_usu INTEGER  NOT NULL  PRIMARY KEY   ,
username varchar(25) NOT NULL UNIQUE,
password varchar(200) NOT NULL 
);

CREATE TABLE REGION(
id_reg integer not null,
name_reg varchar(50),
PRIMARY KEY(id_reg)
);

CREATE TABLE CIUDAD(
id_ciu integer not null,
name_ciu varchar(50),
id_reg integer,
PRIMARY KEY (id_ciu),
FOREIGN KEY (id_reg) REFERENCES REGION(id_reg)
);

CREATE TABLE UNIVERSIDAD(
id_u integer not null,
name_u varchar(50),
id_ciu integer,
PRIMARY KEY (id_u),
FOREIGN KEY (id_ciu) REFERENCES CIUDAD(id_ciu)
);

CREATE TABLE CENTRO_INVESTIGACION(
id_centro integer not null,
name_centro varchar(50),
telefono integer,
id_ciu integer,
PRIMARY KEY (id_centro),
FOREIGN KEY (id_ciu) REFERENCES CIUDAD(id_ciu)
);

CREATE TABLE ROL(
id_rol integer not null,
descrip_rol varchar(50),
PRIMARY KEY(id_rol)
);

CREATE TABLE CATEGORIA(
id_cat integer not null,
descrip_cat varchar(50),
PRIMARY KEY (id_cat)
);

CREATE TABLE INVESTIGADOR(
id_inv integer not null,
rut_inv varchar(10),
name_inv varchar(50),
calle_inv varchar(50),
numero_inv integer,
id_cat integer,
id_ciu integer,
id_rol integer,
PRIMARY KEY (id_inv), 
FOREIGN KEY (id_cat) REFERENCES CATEGORIA(id_cat),
FOREIGN KEY (id_ciu) REFERENCES CIUDAD(id_ciu),
FOREIGN KEY (id_rol) REFERENCES ROL(id_rol)
);

CREATE TABLE AREA_CONOCIMIENTO(
id_area integer not null,
descrip_area varchar(50),
PRIMARY KEY (id_area)
);

CREATE TABLE TIPO_PROYECTO(
id_tipo integer not null,
descrip_tipo varchar(50),
PRIMARY KEY (id_tipo)
);

CREATE TABLE PROYECTO(
num_proy integer not null,
fecha_post date,
cant_años integer,
titulo_proy varchar(50),
monto_proy integer,
id_area integer,
id_tipo integer,
PRIMARY KEY (num_proy),
FOREIGN KEY (id_area) REFERENCES AREA_CONOCIMIENTO(id_area),
FOREIGN KEY (id_tipo) REFERENCES TIPO_PROYECTO(id_tipo)
);

CREATE TABLE CATEGORIA_REVISTA(
id_cat_rev integer not null,
descrip_cat_rev varchar(50),
PRIMARY KEY(id_cat_rev)
);

CREATE TABLE REVISTA(
id_rev integer not null,
name_rev varchar(50),
name_edit varchar(50),
fact_impacto varchar(50),
id_cat_rev integer,
PRIMARY KEY (id_rev),
FOREIGN KEY (id_cat_rev) REFERENCES CATEGORIA_REVISTA(id_cat_rev)
);

CREATE TABLE CONFERENCIA(
id_conf integer not null,
name_conf varchar(50),
fecha_ini_conf date,
fecha_fin_conf date,
pais varchar(50),
name_resp varchar(50),
PRIMARY KEY (id_conf)
);

CREATE TABLE ARTICULO(
id_art integer not null,
titulo_art varchar(50),
PRIMARY KEY (id_art)
);

CREATE TABLE POSEEN(
id_centro integer,
id_inv integer,
id_rol integer,
FOREIGN KEY (id_centro) REFERENCES CENTRO_INVESTIGACION(id_centro),
FOREIGN KEY (id_inv) REFERENCES INVESTIGADOR(id_inv),
FOREIGN KEY (id_rol) REFERENCES ROL(id_rol)
);

CREATE TABLE POSTULAN(
id_inv integer,
num_proy integer,
FOREIGN KEY (id_inv) REFERENCES INVESTIGADOR(id_inv),
FOREIGN KEY (num_proy) REFERENCES PROYECTO(num_proy)
);

CREATE TABLE PERTENECE(
id_inv integer,
id_u integer,
FOREIGN KEY (id_inv) REFERENCES INVESTIGADOR(id_inv),
FOREIGN KEY (id_u) REFERENCES UNIVERSIDAD(id_u)
);

CREATE TABLE ADJUDICAN(
id_inv integer,
num_proy integer,
fecha_adj DATE,
monto_aceptado integer,
fecha_termino DATE,
FOREIGN KEY (id_inv) REFERENCES INVESTIGADOR(id_inv),
FOREIGN KEY (num_proy) REFERENCES PROYECTO(num_proy)
);

CREATE TABLE ESCRIBE(
id_art integer,
id_inv integer,
FOREIGN KEY (id_art) REFERENCES ARTICULO(id_art),
FOREIGN KEY (id_inv) REFERENCES INVESTIGADOR(id_inv)
);

CREATE TABLE SE_PUBLICA(
id_art integer,
id_conf integer,
pag_iniconf integer,
pag_finconf integer,
FOREIGN KEY (id_art) REFERENCES ARTICULO(id_art),
FOREIGN KEY (id_conf) REFERENCES CONFERENCIA(id_conf)
);

CREATE TABLE PUBLICA(
id_art integer,
id_rev integer,
volumen integer,
pag_inirev integer,
pag_finrev integer,
FOREIGN KEY (id_art) REFERENCES ARTICULO(id_art),
FOREIGN KEY (id_rev) REFERENCES REVISTA(id_rev)
);

--INSERT--

INSERT INTO REGION VALUES (01,'BIOBIO');
INSERT INTO REGION VALUES (02,'ARAUCANIA');
INSERT INTO REGION VALUES (03,'METROPOLITANA');

INSERT INTO CIUDAD VALUES (001,'CONCEPCION',01);
INSERT INTO CIUDAD VALUES (002,'TEMUCO',02);
INSERT INTO CIUDAD VALUES (003,'SANTIAGO',03);

INSERT INTO UNIVERSIDAD VALUES (10,'UBB',001);
INSERT INTO UNIVERSIDAD VALUES (11,'UDD',002);
INSERT INTO UNIVERSIDAD VALUES (12,'USACH',003);

INSERT INTO CENTRO_INVESTIGACION VALUES (1,'LOIRA',412544657,001);
INSERT INTO CENTRO_INVESTIGACION VALUES (2,'EBI',412978695,002);
INSERT INTO CENTRO_INVESTIGACION VALUES (3,'SSB',412576849,003);

INSERT INTO ROL VALUES (20,'INVESTIGADOR ADJUNTO');
INSERT INTO ROL VALUES (21,'INVESTIGADOR DIRECTOR');
INSERT INTO ROL VALUES (22,'INVESTIGADOR CO-DIRECTOR');

INSERT INTO CATEGORIA VALUES (30,'INVESTIGADOR SENIOR');
INSERT INTO CATEGORIA VALUES (31,'INVESTIGADOR JOVEN');
INSERT INTO CATEGORIA VALUES (32,'INVESTIGADOR EN VIAS DE CONSOLIDACION');

INSERT INTO INVESTIGADOR VALUES (1,'19364443-0','ESTEBAN SEPULVEDA','GRAL NOVOA 684',20,30,001);
INSERT INTO INVESTIGADOR VALUES (2,'17617382-3','RICARDO MOLINA','DESIDERIO GARCIA 354',21,31,002);
INSERT INTO INVESTIGADOR VALUES (3,'19334433-2','NELSON VERGARA','VICUÑA MACKENNA 076',22,32,003);

INSERT INTO AREA_CONOCIMIENTO VALUES (100,'ADMINISTRACION');
INSERT INTO AREA_CONOCIMIENTO VALUES (101,'INGENIERIA');
INSERT INTO AREA_CONOCIMIENTO VALUES (102,'IDIOMAS');

INSERT INTO TIPO_PROYECTO VALUES (41,'LEGAL');
INSERT INTO TIPO_PROYECTO VALUES (42,'INNOVACION');
INSERT INTO TIPO_PROYECTO VALUES (43,'EDUCATIVO');
INSERT INTO TIPO_PROYECTO VALUES (44,'EXTERNO');

INSERT INTO PROYECTO VALUES (131,'15/10/2016',10,'ADMINISTRACION DE EMPRESAS',1200000,100,41);
INSERT INTO PROYECTO VALUES (132,'22/03/2014',7,'ACTUALIZANDO LA TECNOLOGIA',35000000,101,42);
INSERT INTO PROYECTO VALUES (133,'05/08/2017',5,'INSERTANDO NUEVAS LENGUAS',1000000,102,43);
INSERT INTO PROYECTO VALUES (134,'17/10/2018',3,'OBRAS CARRETERA',9999999,101,44);
INSERT INTO PROYECTO VALUES (135,'10/08/2018',4,'MI CASA PROPIA',2500000,101,44);

INSERT INTO CATEGORIA_REVISTA VALUES (77,'ISI');
INSERT INTO CATEGORIA_REVISTA VALUES (78,'SCIELO');
INSERT INTO CATEGORIA_REVISTA VALUES (79,'SCOPUS');

INSERT INTO REVISTA VALUES (87,'REVISTA MILANO','EUSEBIO LILLO','REGULAR',77);
INSERT INTO REVISTA VALUES (88,'REVISTA WORLD','GABRIELA MISTRAL','ALTO',78);
INSERT INTO REVISTA VALUES (89,'REVISTA PEACE AND LOVE','PABLO NERUDA','BAJO',79);

INSERT INTO CONFERENCIA VALUES (97,'E3','12/09/2017','18/10/2017','ESTADOS UNIDOS','BRAT PITT');
INSERT INTO CONFERENCIA VALUES (98,'UBISOFT','04/11/2017','06/01/2018','CHILE','ROBERT DOWNEY');
INSERT INTO CONFERENCIA VALUES (99,'ELISPORT','29/05/2016','15/07/2016','ITALIA','FRANCESCO DI TOTTI');

INSERT INTO ARTICULO VALUES (67,'LA ULTIMA CITA');
INSERT INTO ARTICULO VALUES (68,'UN MUNDO FANTASTICO');
INSERT INTO ARTICULO VALUES (69,'LAS GRANDES COSAS');
INSERT INTO ARTICULO VALUES (70,'ICLOUD HACKING');

INSERT INTO POSEEN VALUES (1,1,20);
INSERT INTO POSEEN VALUES (2,2,21);
INSERT INTO POSEEN VALUES (3,3,22);

INSERT INTO POSTULAN VALUES (1,131);
INSERT INTO POSTULAN VALUES (2,132);
INSERT INTO POSTULAN VALUES (3,133);
INSERT INTO POSTULAN VALUES (2,134);
INSERT INTO POSTULAN VALUES (2,135);

INSERT INTO PERTENECE VALUES(1,10);
INSERT INTO PERTENECE VALUES(2,11);
INSERT INTO PERTENECE VALUES(3,12);

INSERT INTO ADJUDICAN VALUES(1,131,'16/10/2016',1200000,'20/01/2017');
INSERT INTO ADJUDICAN VALUES(2,132,'23/03/2014',35000000,'25/07/2015');
INSERT INTO ADJUDICAN VALUES(3,133,'06/08/2017',1000000,'10/01/2018');
INSERT INTO ADJUDICAN VALUES (2,135,'16/05/2018',500000,'15/05/2019');

INSERT INTO ESCRIBE VALUES(67,1);
INSERT INTO ESCRIBE VALUES(68,2);
INSERT INTO ESCRIBE VALUES(69,3);
INSERT INTO ESCRIBE VALUES(70,2);

INSERT INTO SE_PUBLICA VALUES(67,97,4,7);
INSERT INTO SE_PUBLICA VALUES(68,98,8,11);
INSERT INTO SE_PUBLICA VALUES(69,99,12,16);
INSERT INTO SE_PUBLICA VALUES(70,98,14,26);

INSERT INTO PUBLICA VALUES(67,87,2,14,21);
INSERT INTO PUBLICA VALUES(68,88,1,11,13);
INSERT INTO PUBLICA VALUES(69,89,4,19,22);

-- 1 VISTA CONFERENCIA_CENTRO--

CREATE VIEW CONFERENCIA_CENTRO AS(

SELECT CEI.NAME_CENTRO, CON.NAME_CONF ,COUNT(*) AS NUMERO_ARTICULOS_PUBLICADOS
FROM CENTRO_INVESTIGACION CEI , POSEEN PO , INVESTIGADOR INV ,ESCRIBE ES , ARTICULO AR,SE_PUBLICA SE ,CONFERENCIA CON
WHERE CEI.ID_CENTRO=PO.ID_CENTRO
AND PO.ID_INV=INV.ID_INV
AND INV.ID_INV = ES.ID_INV
AND ES.ID_ART = AR.ID_ART
AND AR.ID_ART=SE.ID_ART
AND SE.ID_CONF =CON.ID_CONF
GROUP BY CON.NAME_CONF , CEI.NAME_CENTRO
)



SELECT *
FROM CONFERENCIA_CENTRO CEC
WHERE CEC.NUMERO_ARTICULOS_PUBLICADOS = (
SELECT MAX(CEC2.NUMERO_ARTICULOS_PUBLICADOS)
FROM CONFERENCIA_CENTRO CEC2
);



-- 2 VISTA PROYECTOS_POSTULADOS--

CREATE VIEW PROYECTOS_POSTULADOS AS(

SELECT PO.ID_INV, INV.RUT_INV ,COUNT(*) AS POSTULACIONES_PROYECTOS_EXTERNOS
FROM INVESTIGADOR INV , POSTULAN PO ,PROYECTO PRO ,TIPO_PROYECTO TP
WHERE INV.ID_INV=PO.ID_INV
AND PO.NUM_PROY=PRO.NUM_PROY
AND PRO.ID_TIPO = TP.ID_TIPO
AND TP.DESCRIP_TIPO='EXTERNO'
GROUP BY PO.ID_INV, INV.RUT_INV
)

CREATE VIEW PROYECTOS_ADJUDICADOS AS(

SELECT AD.ID_INV,INV.RUT_INV ,COUNT(*) AS PROYECTOS_EXTERNOS_ADJUDICADOS
FROM INVESTIGADOR INV , ADJUDICAN AD ,PROYECTO PRO ,TIPO_PROYECTO TP
WHERE INV.ID_INV=AD.ID_INV
AND AD.NUM_PROY=PRO.NUM_PROY
AND PRO.ID_TIPO = TP.ID_TIPO
AND TP.DESCRIP_TIPO='EXTERNO'
GROUP BY AD.ID_INV,INV.RUT_INV
)

SELECT PP.ID_INV ,INV.NAME_INV ,
PP.POSTULACIONES_PROYECTOS_EXTERNOS,PA.PROYECTOS_EXTERNOS_ADJUDICADOS,
PA.PROYECTOS_EXTERNOS_ADJUDICADOS*100/PP.POSTULACIONES_PROYECTOS_EXTERNOS AS TASA_APROBACION
FROM PROYECTOS_POSTULADOS PP ,PROYECTOS_ADJUDICADOS PA ,INVESTIGADOR INV
WHERE INV.ID_INV=PP.ID_INV
AND PA.ID_INV=INV.ID_INV
AND PP.ID_INV=PA.ID_INV

-- 3 VISTA INVESTIGADOR_REVISTA--

CREATE VIEW INVESTIGADOR_REVISTA AS (

SELECT INV.ID_INV,INV.NAME_INV,INV.RUT_INV,COUNT(*) AS CONTADOR_PRESENTACIONES_REVISTA
FROM INVESTIGADOR INV ,ESCRIBE ES , ARTICULO AR ,PUBLICA PU ,REVISTA REV ,CATEGORIA_REVISTA CAREV
WHERE INV.ID_INV=ES.ID_INV
AND ES.ID_ART=AR.ID_ART
AND AR.ID_ART=PU.ID_ART
AND PU.ID_REV = REV.ID_REV
AND REV.ID_CAT_REV=CAREV.ID_CAT_REV
AND CAREV.DESCRIP_CAT_REV='ISI'
GROUP BY INV.ID_INV
);


CREATE VIEW INVESTIGADOR_CONFERENCIA  AS(

SELECT INV.ID_INV,INV.NAME_INV,INV.RUT_INV,COUNT(*) AS CONTADOR_PRESENTACIONES_CONFERENCIA
FROM INVESTIGADOR INV ,ESCRIBE ES , ARTICULO AR ,SE_PUBLICA SE ,CONFERENCIA CON
WHERE INV.ID_INV=ES.ID_INV
AND ES.ID_ART=AR.ID_ART
AND AR.ID_ART=SE.ID_ART
AND SE.ID_CONF =CON.ID_CONF
GROUP BY INV.ID_INV
);

SELECT IC.NAME_INV,IC.RUT_INV,IC.CONTADOR_PRESENTACIONES_CONFERENCIA , INREV.CONTADOR_PRESENTACIONES_REVISTA
FROM INVESTIGADOR_REVISTA INREV , INVESTIGADOR_CONFERENCIA IC


-- 4 VISTA UNIVERSIDAD_INVESTIGADOR--

CREATE VIEW UNI_INVESTIGADOR AS(

SELECT U.NAME_U,COUNT(*) AS CONTADOR_SENIOR
FROM UNIVERSIDAD U , PERTENECE P ,INVESTIGADOR INV , CATEGORIA CA
WHERE U.ID_U=P.ID_U
AND P.ID_INV=INV.ID_INV
AND INV.ID_CAT=CA.ID_CAT
GROUP BY U.NAME_U
);

SELECT U.NAME_U,C.NAME_CIU,R.NAME_REG,UNI.CONTADOR_SENIOR
FROM UNIVERSIDAD U ,CATEGORIA CA , PERTENECE P ,INVESTIGADOR INV , REGION R , CIUDAD C,
UNI_INVESTIGADOR UNI
WHERE U.NAME_U =UNI.NAME_U
AND INV.ID_CAT=CA.ID_CAT
AND P.ID_INV=INV.ID_INV
AND U.ID_CIU=C.ID_CIU
AND C.ID_REG = R.ID_REG
AND UNI.CONTADOR_SENIOR=(
SELECT MAX(UNI2.CONTADOR_SENIOR)
FROM UNI_INVESTIGADOR UNI2
)
GROUP BY U.NAME_U,C.NAME_CIU,R.NAME_REG,UNI.CONTADOR_SENIOR

-- CONSULTA 5 --

SELECT INV.NAME_INV,INV.RUT_INV
FROM CATEGORIA CA , INVESTIGADOR INV , POSTULAN PO , PROYECTO PRO , TIPO_PROYECTO TP
WHERE CA.ID_CAT=INV.ID_CAT
AND INV.ID_INV=PO.ID_INV
AND PO.NUM_PROY=PRO.NUM_PROY
AND PRO.ID_TIPO=TP.ID_TIPO
AND CA.DESCRIP_CAT='INVESTIGADOR EN VIAS DE CONSOLIDACION'
AND TP.DESCRIP_TIPO='EXTERNO'
AND PRO.FECHA_POST BETWEEN '2012-12-31' AND '2017-12-31'
AND INV.ID_INV
NOT IN
(SELECT PA.ID_INV
FROM PROYECTOS_ADJUDICADOS PA);



