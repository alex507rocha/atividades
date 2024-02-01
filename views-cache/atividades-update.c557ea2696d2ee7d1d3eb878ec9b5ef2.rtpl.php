<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lista de Produtos
    </h1>
  </section>
  
  <!-- Main content -->
  <section class="content">
  
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Produto</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="/admin/atividades/<?php echo htmlspecialchars( $atividade["idatividade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
            <div class="box-body">
              <div class="form-group">
                <label for="d">Título</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars( $atividade["desctituloatividade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  id="desctituloatividade" name="desctituloatividade" placeholder="Digite o título">
              </div>
              <div class="form-group">
                <label for="descatvidade">Descrição da atividade</label>
               <!-- <input type="text" class="form-control" id="descatvidade" name="descatvidade">-->
              <textarea id="descatvidade" rows="5" cols="100" class="form-control" placeholder="Digite a descrição da atividade"  name="descatvidade"><?php echo htmlspecialchars( $atividade["descatividade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
              </div>
  
  
              <div class="form-group">
                <label>Data Início:</label>
  
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="dtinicioatividade" name="dtinicioatividade"  value="<?php echo htmlspecialchars( $atividade["dtinicioatividade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
              <div class="form-group">
                <label>Data Final:</label>
  
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="dtfimatividades" name="dtfimatividades" value="<?php echo htmlspecialchars( $atividade["dtfimatividades"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
              </div>
  
  
  
              <div class="form-group">
                <label for="desurl">URL</label>
                <input type="text" class="form-control" id="linkatividade" name="linkatividade" value="<?php echo htmlspecialchars( $atividade["linkatividade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
              </div>
            </div>
            <!-- select -->
            <div class="form-group">
              <label>Status da atividade</label>
              <select type="number" class="form-control" id="idstatus" name="idstatus">
                <option value=1> Executando</option>
                <option value=2> Concluído</option>
                <option value=3> Encaminhado</option>
                <option value=4> Aprovado</option>
              </select>
            </div>
         
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  document.querySelector('#file').addEventListener('change', function(){
    
    var file = new FileReader();
  
    file.onload = function() {
      
      document.querySelector('#image-preview').src = file.result;
  
    }
  
    file.readAsDataURL(this.files[0]);
  
  });
  </script>