<h2>Importar Alunos</h2>

<form action="/admin/importar_alunos" method="post" enctype="multipart/form-data">
    <label for="arquivo_excel">Selecione o arquivo Excel (.xlsx ou .xls):</label><br>
    <input type="file" name="arquivo_excel" id="arquivo_excel" accept=".xlsx, .xls" required><br><br>
    <button type="submit">Importar</button>
</form>

<p>Por favor, certifique-se de que o arquivo Excel contenha as colunas: nome, email, matrícula, senha, sala.</p>
