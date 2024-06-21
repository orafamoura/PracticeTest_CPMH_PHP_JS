/*Copiar e colar no MySQL workbench*/
CREATE SCHEMA `teste_vita_med_tech`; 

USE teste_vita_med_tech;

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    gender VARCHAR(20) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    address VARCHAR(70) NOT NULL
);

INSERT INTO pacientes (name, birthdate, gender, telephone, address)
VALUES
    ('Joao nascimento', '1998-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Marcos pereira', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Aurelio da junior', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Luiza da silva', '1985-08-25', 'Feminino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Pablo luhan', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Maria aparecida', '1985-08-25', 'Feminino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Carlos de andrade', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Leandro garcia', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Jefferson moraes', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Amanda reis', '1985-08-25', 'Feminino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo augusto da costa', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Lucas Vinicius junior', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Jose Francisco de almeida', '1990-05-15', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Ana Carolina vargas', '1985-08-25', 'Feminino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6'),
    ('Rodolfo falabela', '1985-08-25', 'Masculino', '61123456789', 'qi8 conjunto H casa 6');
    