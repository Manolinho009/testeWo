<?php
require_once "conection.php";
require_once "wo.php";
require_once "wo_controller.php";

$conection = new Conection("PDOTESTE","localhost","root","");
$woController = new WoController();

echo "CON - ".var_dump($conection->get_pdo());
?>


<html>
<head>

<link rel="stylesheet" href="styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    

<div class="container my-4">
    <div class="row">
        <div class="col-6">
            

        <?php
            if(isset($_POST['wo'])){
                $wo = addslashes($_POST['wo']);
                $ns = addslashes($_POST['ns']);
                $ncts = addslashes($_POST['ncts']);

                $woN = new Wo();
                $woN->set_wo($wo);
                $woN->set_ns($ns);
                $woN->set_ncts($ncts);

                $woController->insert_wo($woN,$conection->get_pdo());
            }
        
        ?>
            <form method="POST">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">WO</label>
                <input type="text" class="form-control" id="wo" name="wo" aria-describedby="WO">
              </div>
              <div class="mb-3">
                <label for="ns1" class="form-label">NS</label>
                <input type="time" class="form-control" id="ns1" name="ns">
              </div>
              <div class="mb-3">
                <label for="ncts1" class="form-label">NCTS</label>
                <input type="date" class="form-control" id="ncts1" name="ncts">
              </div>
             
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
        <div class="col-4">
            

            <div class="container">
                
                <ul class="list-group mt-5 text-white" id="lista">   



           
                    
                </ul>
            </div>
        </div>
    </div>
</div>

<?php

  if(isset($_GET['del'])){
    $wo= addslashes($_GET['del']);

    $woN = new Wo();
    $woN->set_wo($wo);
    echo $woN->get_wo();

    $woController->delete_wo($woN,$conection->get_pdo());
    header("location: CRUD.php");
}


?>

<script>
  
// Access the array elements
var passedArray = <?php echo json_encode($woController->get_all($conection->get_pdo())); ?>;
       

function ordenar (wos){
    wos.sort(function (a, b) {
        if (a.NS > b.NS) {
        return -1;
        }
        else if (a.NS < b.NS) {
        return 1;
        }
        else {
            if (a.NCTS > b.NCTS) {
                return 1;
            }
            else if (a.NCTS < b.NCTS) {
                return -1;
            }
            else{
                return 0;
            }
        }
    });
    
}

function stringToDate(wos){

wosEd = []
try {
    wos.forEach(element => {
        
        words = element.NCTS.split('-')
        data = new Date(words[2]+"/"+words[1]+"/"+words[0])
        console.log(data.toLocaleDateString("pt-BR"))
    
        element.NCTS = data
        wosEd.push(element)
    });
} catch (error) {
    console.log(error)
}

return wosEd;
}


function print(wos){

wosE = stringToDate(wos);

ordenar(wosE);

wosE.forEach(element => {
    criarItem(element)
});

}

function criarItem(wo){

li = document.createElement("li");
li.classList.add("list-group-item");
li.classList.add("d-flex");
li.classList.add("justify-content-between");
li.classList.add("align-content-center");
li.innerHTML = '<div class="d-flex flex-row"> <img src="https://img.icons8.com/color/344/send-mass-email.png" width="40" /> <div class="ml-2"> <h6 class="mb-0">'+wo.WO+'</h6> <div class="about"> <span>Ns - '+wo.NS+'</span> <span>Ncts - '+wo.NCTS.toLocaleDateString("pt-BR")+'</span> </div> <span><a href="CRUD.php?del='+wo.ID+'" >DEL</a></span> </div> </div>'
document.getElementById("lista").appendChild(li)

}

print(passedArray);

console.log(passedArray)

</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>