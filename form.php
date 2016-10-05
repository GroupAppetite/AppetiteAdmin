
<form method="POST">
 <p>Nome Ristorante: <input type="text" name="nome_r" value="" /></p>
 <p>Città: <input type="text" name="citta" value="" /></p>
 <p>Indirizzo: <input type="text" name="ind" value ="" /></p>
 <p>Fascia prezzo: <select name="f_p">
    <option value="Bassa">Bassa</option>
    <option value="Normale">Normale</option>
    <option value="Alta">Alta</option>
</select></p>
<p>Descrizione:</p>
<textarea name ="desc" rows="4" cols="50">
</textarea>
 <input type="hidden" name="completed" value ="true" />
 <p><input type="submit"></p>
</form>