-- Criar o banco de dados
DROP DATABASE IF EXISTS tcc;
CREATE DATABASE tcc DEFAULT CHARACTER SET utf8mb4;
USE tcc;

-- Tabela professor
CREATE TABLE professor (
  ID_PROFESSOR INT(11) NOT NULL,
  EMAIL VARCHAR(100) NOT NULL,
  SENHA VARCHAR(64) NOT NULL,
  NOME VARCHAR(50) NOT NULL,
  PRIMARY KEY (ID_PROFESSOR),
  UNIQUE INDEX EMAIL_UNICO (EMAIL)
) ENGINE=InnoDB;

-- Tabela turmas
CREATE TABLE turmas (
  ID_TURMA INT NOT NULL,
  NOME VARCHAR(45),
  professor_ID_PROFESSOR INT(11) NOT NULL,
  PRIMARY KEY (ID_TURMA),
  INDEX fk_turmas_professor_idx (professor_ID_PROFESSOR),
  CONSTRAINT fk_turmas_professor
    FOREIGN KEY (professor_ID_PROFESSOR)
    REFERENCES professor (ID_PROFESSOR)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabela atividade
CREATE TABLE atividade (
  ID_ATIVIDADE INT NOT NULL,
  NOME VARCHAR(45),
  DATA VARCHAR(45),
  VISTO VARCHAR(45),
  PRIMARY KEY (ID_ATIVIDADE)
) ENGINE=InnoDB;

-- Tabela pastas_alunos
CREATE TABLE pastas_alunos (
  ID_ALUNO INT(11) NOT NULL,
  TURMA VARCHAR(20) NOT NULL,
  NOME_ALUNO VARCHAR(50) NOT NULL,
  FOTO VARCHAR(255) NOT NULL,
  turmas_ID_TURMA INT NOT NULL,
  PRIMARY KEY (ID_ALUNO, turmas_ID_TURMA),
  INDEX fk_pastas_alunos_turmas1_idx (turmas_ID_TURMA),
  CONSTRAINT fk_pastas_alunos_turmas1
    FOREIGN KEY (turmas_ID_TURMA)
    REFERENCES turmas (ID_TURMA)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;

-- Tabela de relacionamento pastas_alunos_has_atividade
CREATE TABLE pastas_alunos_has_atividade (
  pastas_alunos_ID_ALUNO INT(11) NOT NULL,
  pastas_alunos_turmas_ID_TURMA INT NOT NULL,
  atividade_ID_ATIVIDADE INT NOT NULL,
  DESCRICAO VARCHAR(45),
  foto_atividade VARCHAR(45),
  PRIMARY KEY (pastas_alunos_ID_ALUNO, pastas_alunos_turmas_ID_TURMA, atividade_ID_ATIVIDADE),
  INDEX fk_atividade_idx (atividade_ID_ATIVIDADE),
  INDEX fk_pastas_alunos_idx (pastas_alunos_ID_ALUNO, pastas_alunos_turmas_ID_TURMA),
  CONSTRAINT fk_pastas_alunos
    FOREIGN KEY (pastas_alunos_ID_ALUNO, pastas_alunos_turmas_ID_TURMA)
    REFERENCES pastas_alunos (ID_ALUNO, turmas_ID_TURMA)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_atividade
    FOREIGN KEY (atividade_ID_ATIVIDADE)
    REFERENCES atividade (ID_ATIVIDADE)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;
