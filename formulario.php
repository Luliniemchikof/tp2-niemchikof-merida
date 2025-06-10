
    <h2>Contesta esta encuesta para obtener los mejores ringtones personalizados!</h2>

    <form action="recibe_form.php" method="POST" novalidate>
            <div>
                <label for="nombre">Su nombre:</label><br>
                <input type="text" name="nombre" id="nombre" placeholder="Ingresá Tu Nombre" required>
                <div class="invalid-feedback">Debe escribir su nombre</div>
            </div>

            <hr>

            <div>
                <label for="nombre">Su apellido:</label><br>
                <input type="text" name="apellido" id="apellido" placeholder="Ingresá tu apellido" required>
                <div class="invalid-feedback">Debe escribir su apellido</div>

            </div>

            <hr>

            <div>
                <label>¿Se ducha escuchando música?</label><br>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="musica_si" name="musica" value="si" required>
                    <label class="form-check-label" for="musica_si">Sí</label>
                </div>
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="musica_no" name="musica" value="no" required>
                    <label class="form-check-label" for="musica_no">No</label>
                        
                </div>
            </div>

            <hr>

            <div>
                <label for="divas">¿Cuál es su diva argentina favorita?</label><br>
                <select name="divas" id="divas" required>
                    <option value="">Seleccione una opción</option>
                    <option value="1">Moria Casán</option>
                    <option value="2">Susana Gimenez</option>
                    <option value="3">Mirtha Legrand</option>
                </select>
                    
            </div>

            <hr>

            <div>
                <label for="peliculas">¿Qué tipo de películas miras?</label><br>
                <select name="peliculas" id="peliculas" required>
                    <option value="">Seleccione una opción</option>
                    <option value="1">Cualquiera mientras sea buena, joder esto si es cine</option>
                    <option value="2">Terror o acción</option>
                    <option value="3">Amor o comedia *suspiro*</option>
                </select>
        
            </div>

            <hr>
            <div>
                <label for="influencer">¿Cuál es tu influencer favorita?</label><br>
                <select name="influencer" id="influencer" required>
                    <option value="">Seleccione una opción</option>
                    <option value="1">Milky Dolly</option>
                    <option value="2">Anto Pane</option>
                    <option value="3">Lilia Lemoine</option>
                </select>
        
            </div>
            <hr>

            <div>
                <label>¿Le gusta vivir en Argentina?</label><br>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="argentina_si" name="argentina" value="si" required>
                    <label class="form-check-label" for="argentina_si">Sí</label>
                </div>
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="argentina_no" name="argentina" value="no" required>
                    <label class="form-check-label" for="argentina_no">No</label>
                        
                </div>
            </div>

            <hr>

            <div>
                <label for="deGrande">Cuando sea grande quiero ser...</label><br>
                <select name="deGrande" id="deGrande" required>
                    <option value="">Seleccione una opción</option>
                    <option value="1">El Uber manija</option>
                    <option value="2">Millonarix como la familia Macri</option>
                    <option value="3">Reconocidx, fabulosx</option>
                </select>
                   
            </div>
            <hr>
            
             <div>
                <label for="facturas">Factura favorita</label><br>
                <select name="facturas" id="facturas" required>
                    <option value="">Seleccione una opción</option>
                    <option value="1">Bola de freile o tortita negra</option>
                    <option value="2">De pastelera</option>
                    <option value="3">Medialunas de manteca, un clásico</option>
                </select>
                   
            </div>

           <hr>

        <input id="enviarButton" type="submit" name="boton_enviar" value="ENVIAR">
     </form>
