    <div class="row vertical-offset-100">
    	<div class="col-md-12" style="background: white; padding: 50px;">
    		<form action="/mvc/user/insert" class="form-control" method="POST">
    			<div class="row" style="margin-top: 10px;">
                     <div class="col-md-12"><input type="text" name="name" placeholder="name" class="form-control"></div>
                 </div> 
                <div class="row" style="margin-top: 10px;">
                     <div class="col-md-12"><input type="text" name="lastname" placeholder="lastname" class="form-control"></div>
                 </div>
                <div class="row">
                     <div class="col-md-12"><input type="text" name="username" placeholder="username" class="form-control"></div>
                 </div>
                 <div class="row" style="margin-top: 10px;">
                     <div class="col-md-12"><input type="text" name="password" placeholder="password" class="form-control"></div>
                 </div>
                 <div class="row" style="margin-top: 10px;">
                     <div class="col-md-1"><input type="submit" value="insertar" class="btn btn-success"></div>
                     <div class="col-md-1"><a href="/mvc/user" class="btn btn-warning">Cancelar</a>
                 </div>
    		</form>
    	</div>
	</div>