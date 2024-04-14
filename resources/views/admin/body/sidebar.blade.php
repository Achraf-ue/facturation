<php dd(\Auth::user()->type); ?>
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                
                <li>
                    <a href="{{route('index')}}" class="waves-effect">
                        <i class="ti-home"></i> <span> Menu </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-receipt"></i><span>Banques<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Ajouter_banque_vue')}}">Ajoute banque</a></li>
                        <li><a href="{{route('list_banque')}}">banques</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Clients<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('Ajouter_client_vue')}}">Ajouter client</a></li>
                        <li><a href="{{route('list_client')}}">clients</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-package"></i> <span>Fourniseurs<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('Ajouter_fourniseur_vue')}}">Ajouter frourniseur</a></li>
                        <li><a href="{{route('list_fourniseur')}}">Fourniseurs</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-receipt"></i><span>factures echeances <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Ajouter_facture')}}">Ajoute facture</a></li>
                        <li><a href="{{route('factures_echeances')}}">factures</a></li>
                    </ul>
                </li>
            
                <?php if( \Auth::user()->type == 'admin'){?>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-receipt"></i><span>Gestion utilisateur<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span></a>
                    <ul class="submenu">
                        <li><a href="{{route('Ajouter_facture')}}">Ajoute utilisateurs</a></li>
                        <li><a href="{{route('factures_echeances')}}">utilisateurs</a></li>
                    </ul>
                </li>
               <?php } ?>

                
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>