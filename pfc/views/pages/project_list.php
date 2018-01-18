<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Lista de Projetos</title>
	
	<?php $this->loadCSS();?>	
</head>
<body class="d-flex flex-column">

	<?php $this->loadHeader()?> 

	<div class="container mt-4 flex-grow">
        <div class="row">
            <div class="col-12">
                <h3>Projetos</h3><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th scope="col">Título</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Editar Projeto</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="project-body">
                                <?php
                                    if(isset($this->data['projects'])){
                                        foreach($this->data['projects'] as $project){                                            
                                            
                                            $row = '<tr>
                                                        <td>'.$project->getTitle().'</td>
                                                        <td>'.$project->getClientName().'</td>'.
                                                        '<td>';
                                            if($project->getStatus() == "opened"){
                                                $row .= '<a href="'.ROOT_URL.'project/update/'.$project->getId().'">Editar Projeto</a>';
                                            }else{
                                                $row .= '<a href="'.ROOT_URL.'project/update/'.$project->getId().'">Visualizar Projeto</a>';
                                            }

                                            $row .=  '</td>
                                                  </tr>';
                                            echo $row;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php $this->loadFooter()?>
	<?php $this->loadJavascript()?>
</html>