import mysql.connector

conexao = mysql.connector.connect(
    host="127.0.0.1",
    user="root",         
    password="", 
    database="tcc"       
)

cursor = conexao.cursor()

cursor.execute("""
    INSERT INTO usuarios (nome, email, senha, tipo)
    VALUES (%s, %s, %s, %s)
""", ("Lucas Silva", "lucas@cliente.com", "senha123", "cliente"))
conexao.commit()

cursor.execute("""
    INSERT INTO categorias (nome, descricao)
    VALUES (%s, %s)
""", ("Camisetas", "Diversas camisetas de várias cores e tamanhos"))
conexao.commit()

cursor.execute("""
    INSERT INTO produtos (nome, descricao, preco, tamanho, cor, estoque, id_categoria, imagem_url)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
""", ("Camiseta Básica", "Camiseta de algodão, confortável e simples.", 59.90, "M", "Branca", 50, 1, "camiseta_basica.jpg"))
conexao.commit()

cursor.execute("""
    INSERT INTO carrinho (id_usuario, id_produto, quantidade)
    VALUES (%s, %s, %s)
""", (1, 1, 2))  
conexao.commit()

cursor.execute("""
    INSERT INTO pedidos (id_usuario, total, status)
    VALUES (%s, %s, %s)
""", (1, 119.80, "Pendente"))  
conexao.commit()

cursor.execute("""
    INSERT INTO itens_pedido (id_pedido, id_produto, quantidade, preco_unitario)
    VALUES (%s, %s, %s, %s)
""", (1, 1, 2, 59.90))  
conexao.commit()

print("Todos os dados foram inseridos com sucesso!")

cursor.close()
conexao.close()
