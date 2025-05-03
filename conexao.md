import mysql.connector

conexao = mysql.connector.connect(
    host="127.0.0.1",
    user="root",         
    password="", 
    database="tcc"       
)

cursor = conexao.cursor()

cursor.execute("""
    INSERT INTO professor (ID_PROFESSOR, EMAIL, SENHA, NOME)
    VALUES (%s, %s, %s, %s)
""", (1, "profa@escola.com", "senha123", "Profa Ana"))

conexao.commit()

cursor.execute("USE mydb")
cursor.execute("""
    INSERT INTO turmas (ID_TURMA, NOME, professor_ID_PROFESSOR)
    VALUES (%s, %s, %s)
""", (1, "Pré I", 1))

conexao.commit()

cursor.execute("USE tcc")
cursor.execute("""
    INSERT INTO pastas_alunos (ID_ALUNO, TURMA, NOME_ALUNO, FOTO, turmas_ID_TURMA)
    VALUES (%s, %s, %s, %s, %s)
""", (1, "Pré I", "Lucas Silva", "lucas.png", 1))

conexao.commit()

cursor.execute("""
    INSERT INTO atividade (ID_ATIVIDADE, NOME, DATA, VISTO)
    VALUES (%s, %s, %s, %s)
""", (1, "Pintura com guache", "2025-05-03", "Sim"))

conexao.commit()

cursor.execute("""
    INSERT INTO pastas_alunos_has_atividade (
        pastas_alunos_ID_ALUNO,
        pastas_alunos_turmas_ID_TURMA,
        atividade_ID_ATIVIDADE,
        DESCRIÇÃO,
        foto_atividade
    ) VALUES (%s, %s, %s, %s, %s)
""", (1, 1, 1, "Lucas pintou um sol com guache", "atividade1.png"))

conexao.commit()

print("Todos os dados foram inseridos com sucesso!")

cursor.close()
conexao.close()
