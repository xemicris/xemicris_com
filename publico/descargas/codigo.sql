--CREO LAS TABLAS

CREATE TABLE SUCURSAL (
    id_sucursal NUMBER(4),
    nombre VARCHAR2(20),
    direccion VARCHAR2(30)   
); 

CREATE TABLE DEPARTAMENTO (
    id_departamento NUMBER(4),
    id_sucursal NUMBER(4),
    nombre VARCHAR2(20),
    direccion VARCHAR2(30)   
); 

CREATE TABLE COMERCIAL (
    dni VARCHAR2(9),
    nombre VARCHAR2(20),
    apellidos VARCHAR2(20),
    fecha_nacimiento DATE,
    bonificacion NUMBER(5,2),
    titulacion VARCHAR2(50),
    id_departamento NUMBER(4),
    id_sucursal NUMBER(4)
); 

CREATE TABLE PROGRAMADOR (
    dni VARCHAR2(9),
    nombre VARCHAR2(20),
    apellidos VARCHAR2(20),
    fecha_nacimiento DATE,
    leguajes VARCHAR2(50),
    puesto VARCHAR2(30),
    id_departamento NUMBER(4),
    id_sucursal NUMBER(4)
); 

CREATE TABLE PROYECTOS(
    cod_proyecto NUMBER(4),
    nombre VARCHAR2(20),
    descripcion VARCHAR2(100),
    id_departamento NUMBER(4),
    id_sucursal NUMBER(4)  
); 

CREATE TABLE CLIENTE(
    id_cliente NUMBER(4),
    nombre VARCHAR2(20),
    telefono NUMBER(9),
    direccion VARCHAR2(30),
    email VARCHAR2(30)
);

CREATE TABLE PROYECTO_CLIENTE(
        cod_proyecto NUMBER(4),
        id_cliente  NUMBER(4)
);




--AÑADO LAS CLAVES PRIMARIAS

ALTER TABLE sucursal ADD CONSTRAINT Sucursal_pk PRIMARY KEY (id_sucursal);

ALTER TABLE departamento ADD CONSTRAINT Departamento_pk PRIMARY KEY (id_departamento, id_sucursal);

ALTER TABLE comercial ADD CONSTRAINT Comercial_pk PRIMARY KEY (dni);

ALTER TABLE programador ADD CONSTRAINT Programador_pk PRIMARY KEY (dni);

ALTER TABLE proyectos ADD CONSTRAINT Proyectos_pk  PRIMARY KEY (cod_proyecto);

ALTER TABLE cliente ADD CONSTRAINT Cliente_pk PRIMARY KEY (id_cliente);

ALTER TABLE proyecto_cliente ADD CONSTRAINT proyecto_cliente_pk PRIMARY KEY (cod_proyecto, id_cliente);


--AÑADO LAS CLAVES EXTERNAS

ALTER TABLE departamento ADD CONSTRAINT departamento_fk FOREIGN KEY (id_sucursal) REFERENCES sucursal (id_sucursal);


ALTER TABLE comercial ADD CONSTRAINT comercial_fk FOREIGN KEY (id_departamento, id_sucursal) REFERENCES departamento (id_departamento, id_sucursal);


ALTER TABLE programador ADD CONSTRAINT programador_fk FOREIGN KEY (id_departamento, id_sucursal) REFERENCES departamento (id_departamento, id_sucursal);


ALTER TABLE proyectos ADD CONSTRAINT proyectos_fk FOREIGN KEY (id_departamento, id_sucursal) REFERENCES departamento (id_departamento, id_sucursal);


ALTER TABLE proyecto_cliente ADD CONSTRAINT proyecto_cliente_fk1 FOREIGN KEY (cod_proyecto) REFERENCES proyectos (cod_proyecto);
ALTER TABLE proyecto_cliente ADD CONSTRAINT proyecto_cliente_fk2 FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente);




--AÑADO RESTRICCIÓN CHECK
ALTER TABLE comercial ADD CONSTRAINT bonificacion_minima CHECK (bonificacion > 250);



--AÑADO RESTRICCIONES UNIQUE Y NOT NULL
ALTER TABLE departamento ADD CONSTRAINT nombre_uk UNIQUE (nombre);
ALTER TABLE departamento MODIFY nombre NOT NULL;

ALTER TABLE sucursal ADD CONSTRAINT sucursal_uk UNIQUE (nombre);
ALTER TABLE sucursal MODIFY nombre NOT NULL;

ALTER TABLE comercial MODIFY nombre NOT NULL;
ALTER TABLE comercial MODIFY apellidos NOT NULL;

ALTER TABLE programador MODIFY nombre NOT NULL;
ALTER TABLE programador MODIFY apellidos NOT NULL;

ALTER TABLE cliente MODIFY nombre NOT NULL;
ALTER TABLE cliente MODIFY email NOT NULL;

ALTER TABLE proyectos ADD CONSTRAINT proyectos_uk UNIQUE (nombre);
ALTER TABLE proyectos MODIFY nombre NOT NULL;



--AÑADO VISTA
CREATE VIEW v_departamentos AS SELECT * FROM departamento;



--AÑADO USUARIO
CREATE USER jose_maria IDENTIFIED BY calavia_rivera;



--AÑADIR ROL
CREATE ROLE Administrador;


--AÑADIR PRIVILEGIOS AL ROL
GRANT CREATE ANY TABLE, DROP ANY TABLE, ALTER ANY TABLE TO Administrador;


--INCLUIR AL USUARIO CREADO DENTRO DEL ROL TAMBIÉN CREADO
GRANT Administrador TO Jose_Maria;


--(RA03_b)
SELECT first_name|| ', ' || last_name|| ', ' ||job_id AS "Trabajador y puesto" FROM Employees;

SELECT first_name, last_name, department_id FROM Employees WHERE department_id = 50 and first_name LIKE 'S%';

SELECT last_name, salary FROM Employees WHERE Salary NOT BETWEEN 6000 AND 11500;

SELECT last_name, job_id, hire_date FROM Employees  WHERE last_name = 'Gietz' OR last_name = 'Jones' ORDER BY hire_date desc;
SELECT last_name, job_id, hire_date FROM Employees WHERE last_name IN ('Gietz', 'Jones') ORDER BY hire_date desc;

SELECT last_name, salary, department_id FROM Employees WHERE salary BETWEEN 6000 AND 10000 AND department_id IN (50, 80);

SELECT last_name FROM Employees WHERE last_name LIKE '%e%a%';


--(RA03_e)
SELECT MAX(salary) AS "Máximo", MIN(salary) AS "Mínimo", SUM(salary) AS "Suma", AVG(salary) AS "Media" FROM Employees;

SELECT COUNT(DISTINCT manager_id) AS "Número de Jefes" FROM Employees;

SELECT MAX(salary) - MIN(salary) AS "Diferencia" FROM Employees;


--RA03_f) 
SELECT first_name, hire_date FROM Employees WHERE hire_date < (SELECT hire_date FROM Employees WHERE last_name = 'Davies') ORDER BY hire_date;

SELECT employee_id, first_name, last_name, salary FROM Employees WHERE salary < (SELECT AVG(salary) FROM Employees) ORDER BY salary ASC;

SELECT employee_id, last_name, department_id FROM Employees WHERE department_id IN (SELECT department_id FROM Employees WHERE last_name LIKE '%g%');


--RA03_c
SELECT location_id, street_address, city, state_province, country_name FROM locations NATURAL JOIN countries;

SELECT first_name, last_name, department_name FROM Employees JOIN departments USING (department_id);

SELECT e.last_name, e.job_id, e.department_id, d.department_name, l.city  FROM Employees e JOIN departments d ON (e.department_id = d.department_id) JOIN  locations l ON (d.location_id = l.location_id) WHERE l.city = 'Toronto';


--RA03_d

SELECT e.first_name, e.last_name, d.department_name FROM  Employees e FULL OUTER JOIN departments d ON (e.department_id = d.department_id); 


--(RA04_b)
 
--Inserte un empleado con el nombre (first_name) y los apellidos (last_name) del autor de la tarea y con salario de 30.000 en el departamento 100 y el resto de los datos a tu elección
INSERT INTO employees (employee_id, first_name, last_name, email, hire_date, job_id, salary, department_id) 
VALUES(99, 'Jose Maria', 'Calavia Rivera', 'jmaria', SYSDATE, 'IT_PROG', 30000, 100);

--Inserte un empleado llamado Juan Márquez con salario de 35000 en el departamento 100 y el resto de los datos a tu elección.
INSERT INTO employees (employee_id, first_name, last_name, email, hire_date, job_id, salary, department_id) 
VALUES(98, 'Juan', 'Marquez', 'jmarquez', SYSDATE, 'FI_ACCOUNT', 35000, 100);

--Consulta los datos de empleados para ver que se han introducido correctamente.
SELECT * FROM employees ORDER BY employee_id;

--Crea un punto de salvado llamado INSERTADO.
SAVEPOINT INSERTADO;

--Modifique el salario de los empleados que sea superior a 20000 disminuyéndolo en 1000.
UPDATE Employees SET salary = salary - 1000 WHERE salary > 20000;

--Modifique el id de departamento a 110 para los empleados cuyo apellido acabe en "ez".
UPDATE Employees SET department_id = 110 WHERE last_name LIKE '%ez';

--Consulta los datos de empleados para ver que se han modificado correctamente.
SELECT * FROM employees WHERE salary > 20000;
select last_name, department_id from employees WHERE last_name LIKE '%ez';

--Crea un punto de salvado llamado MODIFICADO.
SAVEPOINT MODIFICADO;

--Elimine el empleado con tu nombre y apellidos.
DELETE FROM Employees WHERE first_name ='Jose Maria' and last_name = 'Calavia Rivera';

--Elimine los empleado con salario mayor o igual que 30000 y que sean del departamento 110.
DELETE FROM Employees where salary >= 30000 AND department_id = 110;
SELECT * FROM job_history;
DELETE FROM job_history WHERE Employee_id = 98;
DELETE FROM Employees where salary >= 30000 AND department_id = 110;

--Consulta los datos de empleados para ver que se han eliminado correctamente.
SELECT * FROM Employees ORDER BY employee_id asc;

--Crea un punto de salvado llamado ELIMINADO
SAVEPOINT ELIMINADO;



--RA04_c
--	Modifica el salario de todos los empleados por el salario máximo de su categoría profesional. Columna 'max_salary' de tabla JOBS.
UPDATE Employees e SET salary =(SELECT max_salary FROM jobs j WHERE (j.job_id = e.job_id));

--Consulta los datos de empleados para ver que se han modificado correctamente.
SELECT first_name || ' '|| last_name AS "Nombre", salary FROM Employees;

--Crea un punto de salvado llamado MODIFICA_TODO.
SAVEPOINT MODIFICA_TODO;


--RA04_f
--Vuelve al punto de salvado MODIFICADO y comprueba que no se han eliminado los empleados. ¿Qué ocurre?
ROLLBACK TO SAVEPOINT MODIFICADO;
SELECT * FROM employees ORDER BY employee_id;
SELECT first_name || ' '|| last_name AS "Nombre", salary FROM Employees;
SELECT first_name || ' '|| last_name AS "Nombre", department_id FROM Employees WHERE department_id = 110;

--Vuelve al punto de salvado ELIMINADO ¿Qué ocurre?
ROLLBACK TO SAVEPOINT ELIMINADO;

--Vuelve al inicio de la transacción. Comprueba y explica que ha pasado con los datos introducidos, modificados y eliminados.
ROLLBACK;
SELECT * FROM employees ORDER BY employee_id;

--Finaliza y confirma la transacción.
COMMIT;



--(RA05_d) y (RA05_e) 

SET SERVEROUTPUT ON

DECLARE 
	nombreApellidos VARCHAR2(90) := '&nombre_y_apellidos';
	salarioMensual NUMBER(4) := &sal;
	salarioAnualB NUMBER(6) := salarioMensual*12;
	salarioAnual NUMBER(6);
	prima NUMBER(4);
BEGIN
	IF(salarioAnualB>21000)THEN
		prima := 3000;
		salarioAnual := salarioAnualB + prima;
		DBMS_OUTPUT.PUT_LINE('El sueldo anual para el empleado ' || nombreApellidos || ' con un sueldo
		mensual de ' || salarioMensual || ' es de ' ||salarioAnual);
	ELSIF (salarioAnualB >=12000 AND salarioAnual <=21000) THEN
		prima := 1800;
		salarioAnual := salarioAnualB + prima;
		DBMS_OUTPUT.PUT_LINE('El sueldo anual para el empleado ' || nombreApellidos || ' con un sueldo
		mensual de ' || salarioMensual || ' es de ' ||salarioAnual);
	ELSE 
		prima := 1000;
		salarioAnual := salarioAnualB + prima;
		DBMS_OUTPUT.PUT_LINE('El sueldo anual para el empleado ' || nombreApellidos || ' con un sueldo
		mensual de ' || salarioMensual || ' es de ' ||salarioAnual);
	END IF;
END;

-- (RA05_f) y (RA05_g) 

CREATE OR REPLACE FUNCTION getNombreApellidos
(id_empleado employees.employee_id%TYPE)
RETURN VARCHAR2 AS nombreApellido VARCHAR2(90);
BEGIN
    SELECT  first_name || last_name INTO nombreApellido
    FROM Employees
    WHERE employee_id = id_empleado;
    RETURN nombreApellido;
    EXCEPTION 
        WHEN NO_DATA_FOUND THEN
            nombreApellido := 'No existe ningún empleado con el ID: ' || id_empleado;
			RETURN nombreApellido;
END getNombreApellidos;
/
BEGIN
    DBMS_OUTPUT.PUT_LINE(getNombreApellidos(&id_empleado));
END;


CREATE OR REPLACE PROCEDURE getNombreApellidos
(id_empleado IN employees.employee_id%TYPE,
nombre OUT employees.first_name%TYPE,
apellidos OUT employees.last_name%TYPE) IS
BEGIN
    SELECT first_name,last_name INTO nombre, apellidos
    FROM Employees
    WHERE employee_id = id_empleado;
    DBMS_OUTPUT.PUT_LINE(nombre || apellidos || ' es la concatenación de los campos ' || nombre || ' y ' ||apellidos);
    EXCEPTION 
        WHEN NO_DATA_FOUND THEN
            DBMS_OUTPUT.PUT_LINE('No existe un empleado con id ' || id_empleado);
    
END getNombreApellidos;

SET SERVEROUTPUT ON

DECLARE
ide employees.employee_id%TYPE := &codigo;
nom employees.first_name%TYPE;
ape employees.last_name%TYPE;
BEGIN
    getNombreApellidos(ide,nom,ape);
END;


--Crear un nuevo tipo de dato denominado “tipo_notas”, que sea un VARRAY de NUMBER(2) que almacene las 5 notas de un alumno
CREATE TYPE tipo_notas AS VARRAY (5) OF NUMBER(2);


/*Utilizar el tipo de datos “tipo_notas”, para crear un nuevo tipo de dato denominado “tipo_alumno” que tenga los siguientes atributos:
•	numero_matricula NUMBER
•	nombre VARCHAR2(200)
•	notas tipo_notas*/
CREATE OR REPLACE TYPE tipo_alumno AS OBJECT(
numero_matricula NUMBER,
nombre VARCHAR2(200),
notas tipo_notas
);


/*Usar un objeto 'tipo_alumno' para crear una nueva tabla usándolo como plantilla 
y añadiendo la restricción del que el número de matrícula es la clave primaria.*/
CREATE TABLE alumnos OF tipo_alumno(
numero_matricula CONSTRAINT alumnos_pk PRIMARY KEY
);
DESCRIBE alumnos;


/*Insertar un alumno nuevo con los siguientes datos:

•	Numero_matricula = (El DNI del autor de la tarea).
•	Nombre = (Nombre y apellidos del autor de la tarea)
•	Notas = {10, 9, 8, 10, 8}*/
INSERT INTO alumnos VALUES (xxxxxxxx, 'José Maria Calavia Rivera', tipo_notas(10,9,8,10,8));


--Hacer una consulta que muestre solamente el nombre y las notas del alumno con Numero_matricula igual al DNI del autor de la tarea.
SELECT a.nombre, a.notas FROM alumnos a WHERE a.numero_matricula = xxxxxxxx;






-- Crear una tabla de llamada APP_LOG con tres campos (ID_LOG, ACCION, FECHA) y sus restricciones correspondientes.

CREATE TABLE APP_LOG (
ID_LOG VARCHAR2(20)CONSTRAINT id_pk PRIMARY KEY,
ACCION VARCHAR2(20)CONSTRAINT accion_nnull NOT NULL,
FECHA DATE CONSTRAINT fecha_uk UNIQUE
);


--Agrega una nueva columna llamada persona a la tabla APP_LOG. 

ALTER TABLE APP_LOG ADD (persona VARCHAR2(20)); 


--Insertar 2 registros diferentes en la tabla APP_LOG. 

 INSERT INTO APP_LOG (id_log, accion, fecha, persona) 
 VALUES ('fbd1', 'inicio_proyecto', SYSDATE, 'Jose Maria');
 
 INSERT INTO APP_LOG (id_log, accion, fecha, persona) 
 VALUES ('fbd2', 'fin_proyecto', SYSDATE, 'Jose Maria');
 
 
 --Mostrar todo el contenido de la tabla APP_LOG 
 SELECT * FROM APP_LOG
 
 
 --Crear un punto de restauración en la transacción actual llamado INICIO
 SAVEPOINT INICIO;
 
 
 --Insertar 3 registros diferentes en la tabla APP_LOG
 
 INSERT INTO APP_LOG (id_log, accion, fecha, persona) 
 VALUES ('foc1', 'consulta', SYSDATE, 'Pedro');
 
 INSERT INTO APP_LOG (id_log, accion, fecha, persona) 
 VALUES ('foc2', 'insercion_datos', SYSDATE, 'Ana');
 
 INSERT INTO APP_LOG (id_log, accion, fecha, persona) 
 VALUES ('foc3', 'borrado_registro', SYSDATE, 'Roseanne');
 
 
 --Volver al punto de restauración llamado INICIO
 ROLLBACK TO SAVEPOINT INICIO;
 
 
 --Mostrar todo el contenido de la tabla APP_LOG 
 SELECT * FROM APP_LOG;
 
 
 --Modificar la tabla APP_LOG para que sea una tabla de solo lectura
 ALTER TABLE APP_LOG READ ONLY;
 
 
 --Eliminar la tabla APP_LOG
 DROP TABLE APP_LOG;
 
 
--Mostrar todos los comerciales
SELECT * FROM COMERCIALES;


--Mostrar nombre, apellidos, DNI, teléfono y email de todos los comerciales
SELECT nombre, apellidos, dni, telefono, email FROM COMERCIALES;


--Mostrar de todos los comerciales el nombre, apellidos, DNI, teléfono, email, salario y una nueva columna llamada SUBIDA_PROPUESTA que contendrá el salario incrementado en 1000
SELECT nombre, apellidos, dni, telefono, email, salario, salario+1000 AS SUBIDA_PROPUESTA FROM COMERCIALES;


--Mostrar los comerciales cuyo ID_CONCESIONARIO es igual a 1
 SELECT * FROM COMERCIALES WHERE id_concesionario = 1;
 
 
--Insertar en la tabla de los comerciales un nuevo registro con tus datos reales
INSERT INTO comerciales (id_comercial, nombre, apellidos, dni, telefono, email, direccion,
cp,localidad, provincia, comunidad_autonoma, salario, id_concesionario)VALUES (01,'Jose Maria',
'Calavia Rivera', 'xxxxxxxx', 'xxxxxxxx', 'xxxxxxxx', 'xxxxxxx', 00000, 
'xxxxx', 'xxxxx', 'xxxxxx', 23450, 5);


--Mostrar nombre y país de todas las marcas
SELECT nombre_marca, pais FROM marca;


--Mostrar id_marca, nombre y país de aquellas marcas cuyo país sea igual a “ALEMANIA”
SELECT id_marca, nombre_marca, pais FROM marca WHERE pais = 'ALEMANIA';


--Mostrar nombre y país de aquellas marcas cuyo país empiece por la letra E
SELECT nombre_marca, pais FROM marca WHERE pais LIKE 'E%';


--Modificar los datos de la tabla Marcas, para cambiar el nombre del país EE.UU a ESTADOS UNIDOS. 
UPDATE marca SET pais ='ESTADOS UNIDOS' WHERE pais = 'EE.UU';


--Eliminar los registros de la tabla MARCAS cuyo PAIS sea igual a SUECIA
DELETE FROM marca WHERE pais = 'SUECIA';


--Mostrar todas las marcas ordenadas por su nombre
SELECT nombre_marca FROM marca order by nombre_marca;


--Mostrar los datos de todos los coches
SELECT * FROM coches


--Mostrar los datos de aquellos coches cuyo tipo de consumo sea GASOLINA 
SELECT * FROM coches WHERE tipo_consumo = 'GASOLINA';


--Mostrar los datos de aquellos coches cuyo tipo de consumo sea DIESEL y tengan 5 puertas
SELECT * FROM coches WHERE tipo_consumo = 'DIESEL' AND num_puertas=5;


--Mostrar los datos de aquellos coches cuyo color sea ROJO o NEGRO
SELECT * FROM coches WHERE color = 'ROJO' OR color = 'NEGRO';


--Mostrar los datos de aquellos coches cuyo precio sea mayor o igual a 5000 y menor o igual a 10000
SELECT * FROM coches WHERE precio >= 5000 AND precio <= 10000;


--Mostrar los datos de los coches que han sido vendidos, es decir, aquellos cuyo coches cuyo ID_CLIENTE es distinto de NULL
SELECT * FROM coches WHERE id_cliente IS NOT NULL;


--Mostrar todos los coches de la marca “VOLKSWAGEN”. 
SELECT * FROM coches c JOIN marca m ON (c.id_marca = m.id_marca) WHERE m.nombre_marca = 'VOLKSWAGEN';


--Mostrar los datos de los coches del concesionario cuyo país de origen sea “ALEMANIA”. 
SELECT * FROM coches c JOIN marca m ON (c.id_marca = m.id_marca) WHERE m.pais = 'ALEMANIA';


--Mostrar los datos de los coches que hayan estado en estado “Reparación” posteriores al 01/02/2018
SELECT * FROM coches c JOIN estados_coches ec ON (c.id_coche = ec.id_coche) 
JOIN estados e ON (ec.id_estado = e.id_estado)
WHERE ec.fecha > '01/02/2018' AND e.nombre_estado = 'VEHÍCULO EN REPARACIÓN';


--Mostrar los datos de los coches que se encuentran en un estado con nombre “VEHÍCULO DE KM 0”. 
SELECT * FROM coches c JOIN estados_coches ec ON (c.id_coche = ec.id_coche) 
JOIN estados e ON (ec.id_estado = e.id_estado)
WHERE e.nombre_estado = 'VEHÍCULO DE KM 0';


--Realizar todas las combinaciones de compra posible entre concesionario y cliente, es decir, el producto cartesiano de ambas tablas.
SELECT * FROM concesionario CROSS JOIN clientes;
 
 
 
 
 