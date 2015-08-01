<?php
        require_once("includes/autoload.php");
	
        // Prepare page parameters
        $mode = "register";
        
        // Set up page
	$page = new Page($mode);
        
        // Handle POST data
        if (!empty($_POST))
        {
            $formvalid = true;
            $mysql = new MySQL();
            
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);
            
            if (empty($name))
            {
                $page->AddToSidebar(new SidebarHint(_("User name may not be empty!"), true));
                $formvalid = false;
            } else {
                if ($mysql->CheckUsername($name))
                {
                    $page->AddToSidebar(new SidebarHint(_("User name is taken."), true));
                    $formvalid = false;
                }
            }
            if (empty($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                $page->AddToSidebar(new SidebarHint(_("That does not seem to be a valid e-mail address."), true));
                $formvalid = false;
            }
            if (empty($password))
            {
                $page->AddToSidebar(new SidebarHint(_("Please choose a password!"), true));
                $formvalid = false;
            }
            if ($password != $password2)
            {
                $page->AddToSidebar(new SidebarHint(_("Passwords do not match!"), true));
                $formvalid = false;
            }
            
            if ($formvalid)
            {
                $result = $mysql->CreateUser($name, $mail, $password);
                if ($result == "OK")
                {
                    $page->setContentID(1);
                    $page->AddToSidebar(new SidebarHint(_("User ") . $name . _(" has been created, but still needs to be activated.")));
                } else {
                    $page->AddToSidebar(new SidebarHint(_("MySQL error. Please try again or contact administrator: <br>\r\n") . $result, true));
                }
            }
        } else {
            $page->AddToSidebar(new SidebarHint(_("Signing up allows you to start interacting with the site. Before a new account can be used, it will have to be activated via e-mail, so make sure to use a valid address."))); 
        }
        
        
        // Customise page content (TODO: Move customisation to in-app admin menu. This should be completely empty.
	
        // Set the site name to be displayed on all the pages and the section
	$sitename = "Nuntii";
        $sitesection = "Registration";
        // TODO: Get $sitename from config and $sitesection from $page (maybe even use $page->sitesection in includes/html.php instead?)
        
        // Load HTML Boilerplate
        require_once("includes/html.php");