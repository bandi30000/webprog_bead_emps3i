<h2>Írj nekünk</h2>
<p>Kérlek az üzenetk feldolgozásának egyszerűsítése érdekében az alábbi űrlapon keresztül kezd el a kommunikációt!</p>
<script type="text/javascript" src="scripts/urlap.js"></script>
<form action="urlap.php" method="post" class="row" name="uzenet" onsubmit="return ellenoriz();">
<div>
            <label><input type="text" id="nev" name="nev" size="20" maxlength="40">Név (minimum 5 karakter): </label>
            <br/>
            <label><input type="text" id="email" name="email" size="30" maxlength="40">E-mail (kötelező): </label>
            <br/>
            <label> <textarea id="szoveg" name="szoveg" cols="40" rows="10"></textarea> Üzenet (kötelező): </label>
            <br/>
            <input id="kuld" type="submit" value="Küld">
            <button onclick="ellenoriz();" type="button">Ellenőriz</button>
</div>

</form>
