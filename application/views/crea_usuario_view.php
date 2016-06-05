
    <div class="cuerpo">
     
        <form action="" method="POST" >   

           <div class="col-md-12" display id="datos" >


               <div class="form-group">

                   <div class="alert alert-danger">
                       <?php echo validation_errors(); ?>
                   </div>

                   <div class="form-inline">  
                       
                        <label for="Usuario">Usuario</label>
                        <input type="text" name="Usuario" class ="form-control" value="<?=set_value('Usuario')?>" size="50" />
                        <label for="Password">Password</label>
                        <input type="text" name="Password" class ="form-control" value="<?=set_value('Password')?>" size="50" />
                        <label for="Perfil">Perfil</label>
                        <input type="text" name="Perfil" class ="form-control" value="<?=set_value('Perfil')?>" size="50" />
                        
                        <br>

                        <input class="btn btn-success" id="grabar" type="submit" value="Grabar Usuario">

                    </div>

                </div> 
            </div>
        </form>   
    </div>
      

    
    
        
     

    
      </body>
</html>