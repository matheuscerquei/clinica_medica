create database clinicaMedica;
use clinicaMedica;

create table paciente(
ID_paciente int auto_increment primary key,
nome varchar(50) not null,
data_nascimento date not null,
email varchar(50) unique not null,
telefone varchar(11) not null,
endereco varchar(50) not null,
genero enum("MASCULINO","FEMININO", "OUTRO") not null
);

create table consulta(
ID_consulta int auto_increment primary key,
ID_FK_paciente int not null,
especialidade enum(
"CARDIOLOGIA", "DERMATOLOGIA", "ENDOCRINOLOGIA", "NEUROLOGIA",
 "ORTOPEDIA", "ONCOLOGIA", "GASTROENTEROLOGIA", "PNEUMOLOGIA", 
 "REUMATOLOGIA", "PSIQUIATRIA", "UROLOGIA", "GINECOLOGIA", "OFTALMOLOGIA") not null,
 data_consulta datetime not null,
 foreign key (ID_FK_paciente) references paciente(ID_paciente)
);

CREATE OR REPLACE VIEW agenda as select p.ID_paciente, p.nome, p.telefone, p.genero, c.ID_consulta, c.especialidade , c.data_consulta 
from paciente p inner join consulta c on p.ID_paciente = c.ID_FK_paciente;

select * from consulta;