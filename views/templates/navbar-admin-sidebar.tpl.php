<?php if($_COOKIE["toggled-sidebar"] == 'true'): ?>
<div class="navbar-sidebar collapsed" id="navbar">
<?php else: ?>
<div class="navbar-sidebar toggled" id="navbar"> 
<?php endif; ?>

	<div class="siteinfo">
		<a href="<?php echo ROOT_URL ?>admin">
			<img class="navbar-icon" src="<?php echo ROOT_URL ?>/public/img/dark.svg">
			<span class="link-text"><?php echo $sitename; ?></span>
		</a>
	</div>

	<ul class="nav" id="menu">
		<li class="<?php echo ($c == "admin" && $a == "index" )?"active":"";?>"><a href="<?php echo ROOT_URL ?>admin"><span class="icon icon-home"></span><span class="link-text">Dashboard</span></a></li>
		<li class="dropdown-link <?php echo ($c == "article" && $a == "allArticles" )?"active":"";?>">
			</span><a href="#""><span class="icon icon-newspaper"></span><span class="link-text">Articles <span class="icon-ctrl carret-down" id="dropdown-toggle"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php echo ROOT_URL ?>admin/articles"> Tous les articles</a> </li> 
					<li><a href="<?php echo ROOT_URL ?>admin/ajouter-article">Ajouter un article</a> </li> 
					<li><a href="<?php echo ROOT_URL ?>admin/categories">Catégories</a> </li> 
					<li><a href="<?php echo ROOT_URL ?>admin/tags">Tags</a> </li> 
				</ul>
			</div>
		</li>
		<li class="dropdown-link <?php echo ($c == "comment" && $a == "index" )?"active":"";?>" ><a href="#"><span class="icon icon-file-empty"></span><span class="link-text">Pages<span class="icon-ctrl carret-down"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php echo ROOT_URL ?>admin/pages">Toutes les pages</a> </li> 
					<li><a href="<?php echo ROOT_URL ?>admin/ajouter-page">Ajouter une page</a> </li>  
				</ul>
			</div>
		</li>
		<li classs="<?php echo ($c == "comment" && $a == "index" )?"active":"";?>"><a href="<?php echo ROOT_URL ?>admin/medias"><span class="icon icon-images"></span><span class="link-text">Médias</span></a></li>
		<li class="dropdown-link" >
			 
			<a href="#"><span class="icon icon-alarm"></span><span class="link-text">Evènements<span class="icon-ctrl carret-down"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php echo ROOT_URL ?>admin/evenements">Tous les événements</a> </li> 
					<li><a href="<?php echo ROOT_URL ?>admin/ajouter-evenements">Ajouter un événement</a> </li>  
				</ul>
			</div>
		</li>
		<li class="<?php echo ($c == "comment" && $a == "index" )?"active":"";?>"><a href="<?php echo ROOT_URL ?>admin/commentaires"><span class="icon icon-bubbles2"></span><span class="link-text">Commentaires</span></a></li>
		<li class="<?php echo ($c == "user" && $a == "allUsers" )?"active":"";?>"><a href="<?php echo ROOT_URL ?>admin/utilisateurs"><span class="icon icon-users"></span><span class="link-text">Utilisateurs</span></a></li>
		<li class="dropdown-link <?php echo ($c == "theme" && $a == "index" )?"active":"";?>"> 
			<a href="#"><span class="icon icon-paint-format"></span><span class="link-text">Apparence<span class="icon-ctrl carret-down"></span></span></a>
			<div class="dropdown">
				<ul> 
					<li><a href="<?php echo ROOT_URL ?>admin/modifier-theme">Modifier le thème</a> </li> 
					<li><a href="<?php echo ROOT_URL ?>admin/themes">Mes thèmes</a> </li>  
					<li><a href="<?php echo ROOT_URL ?>admin/theme-creator">Theme Creator</a> </li>  
				</ul>
			</div></li>
			<li class="<?php echo ($c == "settings" && $a == "index" )?"active":"";?>"><a href="<?php echo ROOT_URL ?>admin/parametres"><span class="icon icon-equalizer"></span><span class="link-text">Paramètres</span></a></li>
    </ul>
</div>

<?php if($_COOKIE["toggled-sidebar"] == 'true'): ?>
<div class="second-navbar" id="second-navbar">
<div class="hamburger menu-sidebar" id="hamburger-menu">
<?php else: ?>
<div class="second-navbar collapsed" id="second-navbar"> 
<div class="hamburger menu-sidebar is-active" id="hamburger-menu">
<?php endif; ?>


	<span class="line"></span>
	<span class="line"></span>
	<span class="line"></span>
</div>

<div class="breadcrumb" id="breadcrumb">
	<span class="icon <?php echo $icon;?>"></span> <?php echo $title; ?> 
</div>

</div>
          <div class="user-menu">
            <a href="#">
              <span> <?php echo Singleton::getUser()->getLogin(); ?> </span>
              <img class="avatar" src="<?php echo ROOT_URL ?>/public/img/user.jpg">
              <span class="icon-ctrl carret-down-user">
            </a>
        </div>