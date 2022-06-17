<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<title>Cadastro para uso do Sistema</title>
</head>

<body>
	<div id="result">
<section>
  <div class="content">
    <div class="container-fluid">
      <div class="card card-outline card-primary">
        <div class="row">
          <div class="col-lg-4">
            <label>Nome da Loja<br/><span style="font-size: 9px">https://maxcomanda.com.br/<span id="namefolder"></span></span></label>
            <input name="folder" id="folder" class="form-control"  onBlur="valid_folder(this.value)">
          </div>
			<div class="col-lg-4">
            <label>Nome do Contato da Loja<br/><br/></label>
            <input name="name_contact" id="name_contact" class="form-control">
          </div>
			<div class="col-lg-4">
            <label>E-mail de Contato<br/><br/></label>
            <input name="mail_contact" id="mail_contact" class="form-control">
          </div>
			
			<div class="col-lg-3">
            <label>WhatsApp</label>
            <input name="WhatsApp" id="WhatsApp" class="form-control">
          </div>
			<div class="col-lg-3">
            <label>CNPJ/CPF</label>
            <input name="CNPJ_CPF" id="CNPJ_CPF" class="form-control">
          </div>
			<div class="col-lg-3">
            <label>CEP</label>
            <input name="CEP" id="CEP" class="form-control">
          </div>
			<div class="col-lg-3">
            <label>Módulos Importantes para sua loja</label>
				<select name="modules" id="modules" class="form-control">
					<option value="Todos">Todos</option>
					<option value="Gestão">Gestão</option>
					<option value="Aplicativo">Aplicativo</option>
					<option value="Site">Site</option>
					<option value="Gestão + Aplicativo">Gestão + Aplicativo</option>
					<option value="Gestão + Site">Gestão + Site</option>
				</select>
          </div>
			<div class="col-lg-12">
			<div style="text-align: right">
				<button class="btn btn-primary" onClick="btnRecord()">Gravar</button>
				</div>
			</div>
        </div>
      </div>
    </div>
  </div>
</section>
		</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../js/ws/ws.js"></script>