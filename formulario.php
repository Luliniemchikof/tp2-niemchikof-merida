
    <h2>Contesta esta encuesta para obtener los mejores ringtones personalizados!</h2>

    <form action="recibe_form.php" method="POST" novalidate>
            <div>
                <label for="nombre">Su nombre:</label><br>
                <input type="text" name="nombre" id="nombre" placeholder="Ingresá Tu Nombre" required>
                <div class="invalid-feedback">Debe escribir su nombre</div>
            </div>

            <hr>

            <div>
                <label>¿Se considera un ciudadano/a de bien?</label><br>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="ciudadano_si" name="ciudadano" value="si" required>
                    <label class="form-check-label" for="ciudadano_si">Sí</label>
                </div>
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="ciudadano_no" name="ciudadano" value="no" required>
                    <label class="form-check-label" for="ciudadano_no">No</label>
                        
                </div>
            </div>

            <hr>

            <div>
                <label for="dolares">¿Cuántos dólares compró luego de la maravillosa caída del cepo?</label><br>
                <select name="dolares" id="dolares" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Menos de 100usd">Menos de 100u$d</option>
                    <option value="Entre 100usd y 1000usd">Entre 100u$d y 1000u$d</option>
                    <option value="Entre 1000usd y 10000usd">Entre 1000u$d y 10000u$d</option>
                    <option value="Más de 10000usd">Más de 10000u$d</option>
                    <option value="Ninguno">Ninguno, no llego a fin de mes</option>
                </select>
                    
            </div>

            <hr>

            <div>
                <label for="cultura_cierre">¿Qué próximo espacio de arte c0munist4 y zurd0 debería cerrar?</label><br>
                <select name="cultura_cierre" id="cultura_cierre" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Cine Gaumont">Cine Gaumont</option>
                    <option value="Usina del Arte">Usina del Arte</option>
                    <option value="UNA Multimediales">UNA Multimediales</option>
                    <option value="Filosofía y Letras UBA">Filosofía y Letras UBA</option>
                    <option value="La casa de Lali">La casa de Lali</option>
                    <option value="Ninguno">Ninguno, todos los espacios son extremadamente importantes para nuestra cultura</option>
                </select>
        
            </div>

            <hr>

            <div>
                <label>¿Ha vendido algún órgano en el último año?</label><br>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="organo_si" name="organo" value="si" required>
                    <label class="form-check-label" for="organo_si">Sí</label>
                </div>
                <div class="form-check mb-3">
                    <input type="radio" class="form-check-input" id="organo_no" name="organo" value="no" required>
                    <label class="form-check-label" for="organo_no">No</label>
                        
                </div>
            </div>

            <hr>

            <div>
                <label for="filosofia">¿Qué tan de acuerdo está con la Filosofía Muy Interesante?</label><br>
                <select name="filosofia" id="filosofia" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Bastante">Bastante</option>
                    <option value="Mucho">Mucho</option>
                    <option value="Un montón">Un montón</option>
                    <option value="Re de acuerdo">Recontra re de acuerdo</option>
                    <option value="No se qué es">La posta nunca me quedó muy en claro qué es</option>
                    </select>
                   
            </div>
           <hr>

        <input id="enviarButton" type="submit" name="boton_enviar" value="ENVIAR">
     </form>
