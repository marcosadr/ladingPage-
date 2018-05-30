<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lading Page - Dados</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script></head>    
</head>
<body>
    
    <?php
        $name = $_POST['nome'];
        $email = $_POST['email'];
        $telefone  = $_POST['telefone'];
        $empresa = $_POST['empresa'];
        $cep = $_POST['cep'];
    
    if($name && $email && $telefone && $empresa && $cep){
        
        $key = 'GAiymP5CPlaklcBuV5ul0Z3SnCHkG31M';
        $app_secret = 'DDhmGSkrxdxN8c5FD7sj97vNuwd9m12relt6nOnSWC1EOXpU';
        
        $url = "https://webmaniabr.com/api/1/cep/".$cep."/?app_key=".$key."&app_secret=".$app_secret;
        
        function callAPI($method, $url, $data){
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'APIKEY: 111111111111111111111',
                'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            
            $result = curl_exec($curl);
            
            if(!$result){
                die("Connection Failure");
            }

            curl_close($curl);

            return $result;
        }
        
        $get_data = callAPI('GET', $url,false);
        
        $response = json_decode($get_data, true);
    ?>   
    <div class="container">           
        <div class="card">
        <div class="card-header">
            <h3>Dados</h3>
        </div>               
            <address style="margin: 5px"><b>Nome: </b><?php echo $name; ?></address>
            <address style="margin: 5px"><b>Email: </b><?php echo $email; ?></address>
            <address style="margin: 5px"><b>Telefone: </b><?php echo $telefone; ?></address>
            <address style="margin: 5px"><b>Empresa: </b><?php echo $empresa; ?></address>
            <hr/>
            <?php if($response[endereco] == true) { ?>
            <address style="margin: 5px"><b>Endereço: </b><?php echo $response[endereco]; ?></address>
            <address style="margin: 5px"><b>Bairro: </b><?php echo $response[bairro]; ?></address>
            <address style="margin: 5px"><b>Cidade: </b><?php echo $response[cidade]; ?></address>
            <address style="margin: 5px"><b>CEP: </b><?php echo $response[cep]; ?></address>
            <address style="margin: 5px"><b>UF: </b><?php echo $response[uf]; ?></address>
            <?php }else{ ?>
                <address style="margin: 5px"><b>Endereço não encontrado! </b></address>
           <?php } ?>
        </div>
    <?php
    }
    else {
        header( "Location: http://localhost/ladingpage/" );
    } 
    ?>
</body>
</html>