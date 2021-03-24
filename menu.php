       <!-- Sidebar  -->
    <aside id="sidebar_left" class="" style="padding-top:10px;">

        <!-- Sidebar Left Wrapper  -->
        <div class="sidebar-left-content nano-content">

            <!-- Sidebar Menu  -->
            <ul class="nav sidebar-menu">

                <?php

                include('buscaTabelas.php');
               
                $contMenu = 0;
                foreach ($tableName as &$value)
                {

                    $expl = explode("|", $value);
                    $value = $expl[0];
                    $DBTable = $expl[1];
         
                    //print $value.' ';

                    switch ($value) {
                        case 'Clientes':
                            $FAicon = "sb-menu-icon fa fa-group";
                            break;
                        case 'Colaboradores':
                            $FAicon = "sb-menu-icon fa fa-sitemap";
                            break; 
                        case 'Contratações':
                            $FAicon = "sb-menu-icon fa fa-briefcase";
                            break;
                        case 'Empresas':
                            $FAicon = "sb-menu-icon fa fa-book";
                            break;
                        case 'Ferramentas':
                            $FAicon = "sb-menu-icon fa fa-wrench";
                            break;   
                        case 'Lançamentos':
                            $FAicon = "sb-menu-icon fa fa-file-text-o";
                            break;
                        case 'Projetos':
                            $FAicon = "sb-menu-icon fa fa-desktop";
                            break;
                        case 'Usuários':
                            $FAicon = "sb-menu-icon fa fa-user";
                            break;                        
                    }
                
                ?>

                <!-- <li class="active"> -->
                <!-- <li id="menu_<?php print $contMenu; ?>" class="<?php if($contMenu == 0){print 'active';} ?>">-->
                <li id="menu_<?php print $contMenu; ?>">
                    <a href="javascript:void(0)" onclick="loadPage('<?php print $DBTable; ?>', 'menu_<?php print $contMenu; ?>')">
                        <span class="caret"></span>
                        <span class="<?php print $FAicon; ?>"></span>
                        <span class="sidebar-title"><?php print $value; ?> </span>
                    </a>                
                </li>

                <?php
                $contMenu += 1;
                } ?>

               
                <li class="">
                    <a class="accordion-toggle" href="#">
                        <span class="caret"></span>
                        <span class="sb-menu-icon fa fa-bar-chart-o"></span>
                        <span class="sidebar-title">Faturameto</span>
                    </a>
                    <ul class="nav sub-nav">
                        <li>
                            <a href="javascript:void(0)" onclick="loadUnicPage('FaturamentoProjeto.php?por=Projeto', 'filtro')">
                                Projeto
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                Cliente 
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                Colaborador 
                            </a>
                        </li>
                        <li class="">
                            <a href="">
                                Empresa
                            </a>
                        </li>
                    </ul>
                </li>
             

            </ul>
            <!-- /Sidebar Menu  -->

        </div>
        <!-- /Sidebar Left Wrapper  -->

    </aside>
    <!-- /Sidebar -->