<?php
// Initialize the session
session_start();
 
// Vérifions si l'utilisateur est connecté, sinon redirigeons-le vers la page de connexion
if(!isset($_SESSION["connecter"]) || $_SESSION["connecter"] !== true){
    header("location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Danger View - Admin | Ajouter</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/logo1.png" />
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #000 !important;">
            <span class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon" style="cursor: pointer;">
                    <i class="fa fa-list" aria-hidden="true" id="sidebarToggle"></i>
                  </div>
                <div class="sidebar-brand-text">
                   &nbsp;&nbsp;&nbsp; Danger <b style="color: #ff1300;">view</b>
                </div>
              </span>
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="./operateur_home.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Accueil</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="./ajouter-danger.php">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <span>Ajouter un danger</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="./liste-des-danger-ajouter.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Liste des danger ajouter</span></a>
            </li>
        </ul>
        <!-- / Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background: #ffc500 !important;font-weight: 700;">
                    <strong id="sidebarToggleTop" class="d-md-none" style="color: #fff !important;font-weight: 900;">
                      Danger <span style="color:#000">View</span>
                    </strong>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope fa-fw" style="color: #fff !important;font-weight: bold;"></i>
                                <span class="d-none d-lg-inline text-gray-600 small" style="color: #fff !important;font-weight: 500;">Notifications</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Messages
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="../img/logo.png" alt="">
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Bonjour</div>
                                        <div class="small text-gray-500">Nom Visiteur · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Lire plus de messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="https://cdn.pixabay.com/photo/2013/07/13/10/07/man-156584_960_720.png">&nbsp;&nbsp;
                                <span class="d-none d-lg-inline text-gray-600 small" style="color: #fff !important;font-weight: 800;">
                                    <?= htmlspecialchars($_SESSION["prenom"]); ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-user fa-sm fa-fw mr-2"></i> Mon Profil
                                </a>
                                <a class="dropdown-item" href="../php/logout.php">
                                    <i class="fa fa-sign-out fa-sm fa-fw mr-2"></i> Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- / Topbar -->

                <!-- Contenue de la page -->
                <div class="container-fluid">
                    
                    <div class="card mb-4">
                        <h5 class=" h4 card-header" style="background: #a19e9e !important">
                            <center>Ajout d'informations</center>
                        </h5>
                        <div class="card-body">
                        <div class="row">
          <div class="col-lg-12">
            <div class="p-1">
              <form method="post" class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="">
                    <h5 style="color: #ffc500">Informations générale</h5>
                </div>
                <hr>
                <div class="form-group row ">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="numeroOrdre" name="numeroOrdre" placeholder="Numero d'ordre">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                           
                        </span>
                    </small>
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="source" name="source" placeholder="Veillez indiquez la Source">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                            
                        </span>
                    </small> 
                 </div>
                  <div class="col-sm-5">
                    <input type="text" class="form-control form-control-user" id="date" name="date" placeholder="Indiquez la date">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                          
                        </span>
                    </small>
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control " rows="5" id="comment" placeholder="Description..."></textarea>
                </div>
                <div class="mt-3">
                    <h5 style="color: #ffc500">Description du lieu</h5>
                </div>
                <hr>
                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="nomDuLieu" name="nomDuLieu" placeholder="Nom de l'endroit">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                            
                        </span>
                    </small>
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="description" name="description" placeholder="Décrivez l'endroit">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                            
                        </span>
                    </small> 
                 </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control form-control-user" id="date" name="date" placeholder="Indiquez la date">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                          
                        </span>
                    </small>
                  </div>
                </div>
                <div class="form-group row ">
                  <div class="col-sm-4 mb-3 mt-2 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="longitude" name="longitude" placeholder="Longitude">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                           
                        </span>
                    </small>
                  </div>
                  <div class="col-sm-4 mt-2">
                    <input type="password" class="form-control form-control-user" id="latitude" name="latitude" placeholder="Latitude">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                            
                        </span>
                    </small> 
                 </div>
                 <div class="col-sm-4 mt-2">
                    <input type="password" class="form-control form-control-user" id="ville" name="idVille" placeholder="Ville">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                        
                        </span>
                    </small> 
                 </div>
                </div>
                <div class="mt-3">
                    <h5 style="color: #ffc500">Information sur les différents acteurs</h5>
                </div>
                <hr>
                <div class="form-group row ">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="intitule" name="intitule" placeholder="Type d'acteur">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                            
                        </span>
                    </small>
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="description" name="description" placeholder="Décrivez l'endroit">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                           
                        </span>
                    </small> 
                 </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control form-control-user" id="date" name="date" placeholder="Indiquez la date">
                    <small style="color: #ff1300 !important">
                        <span class="align-items-center text-center">
                            
                        </span>
                    </small>
                  </div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary btn-user btn-block" style="background: #ff1300!important; color:#fff;" value="Enregister">
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
                        </div>
                    </div>
                </div>
                <!-- /Contenue de la page -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white" style="background: #ffc500 !important">
                <div class="container">
                    <div class="copyright text-center">
                        <span>Copyright &copy; 2020, design by Sheila Melissa</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- ./ Wrapper -->

    <!-- Navigation top-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">
        ! function(t) {
            "use strict";
            t("#sidebarToggle, #sidebarToggleTop").on("click", function(o) {
                    t("body").toggleClass("sidebar-toggled"),
                        t(".sidebar").toggleClass("toggled"),
                        t(".sidebar").hasClass("toggled") &&
                        t(".sidebar .collapse").collapse("hide")
                }),
                t(window).resize(function() {
                    t(window).width() < 768 &&
                        t(".sidebar .collapse").collapse("hide")
                }),
                t("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function(o) {
                    if (768 < t(window).width()) {
                        var e = o.originalEvent,
                            l = e.wheelDelta || -e.detail;
                        this.scrollTop += 30 * (l < 0 ? 1 : -1), o.preventDefault()
                    }
                }), t(document).on("scroll", function() {
                    100 < t(this).scrollTop() ? t(".scroll-to-top").fadeIn() :
                        t(".scroll-to-top").fadeOut()
                }),
                t(document).on("click", "a.scroll-to-top", function(o) {
                    var e = t(this);
                    t("html, body").stop().animate({
                            scrollTop: t(e.attr("href")).offset().top
                        }, 1e3, "easeInOutExpo"),
                        o.preventDefault()
                })
        }(jQuery);
    </script>
</body>

</html>