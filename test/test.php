<div id="addingcoinsreturn">Labas...</div>
<button onclick="labas(2)">Labas</button>

<script>
    function labas(str) {
        var myRequest = new XMLHttpRequest();
        myRequest.open("GET", "testajax.php?q=" + str, true);
        myRequest.onreadystatechange = function () {
            if (myRequest.readyState === 4) {
                document.getElementById('addingcoinsreturn').innerHTML = myRequest.responseText;
            }
        };
        myRequest.send();
    }
</script>