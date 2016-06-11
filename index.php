<?php
    $stime = microtime(true);
    require_once("includes/autoload.php");
	session_start();
	
        // Get parameters
        $get_mode = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $get_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $get_filter = filter_input(INPUT_GET, 'f', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        
        if (!empty($_POST))
        {
            $get_mode = filter_input(INPUT_POST, 'mode', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        }
        
        if (!isset($get_mode))
        {
            $get_mode = "list";
        }
        
        // Set up page
	$page = new Page($get_mode, $get_id, $get_filter);
        
        // Check for special modes
        if($get_mode == "logout")
        {
            unset($_SESSION["user"]);
            session_destroy();
            $page->AddToSidebar(new SidebarHint(_("You have been logged out!"), true));
        }
        
        // Handle POST data
        if (!empty($_POST))
        {
            switch ($get_mode)
            {
                case "register":
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
                        if ($mysql->CheckUserName($name))
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
                    break;
                case "login":
                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $mysql = new MySQL();
                    if ($mysql->CheckUserPass($name, $password))
                    {
                         $_SESSION["user"] = new User($name);
                        $page->AddToSidebar(new SidebarHint(_("Welcome, ") . $_SESSION["user"]->GetName() . "!"));
                    } else {
                        $page->AddToSidebar(new SidebarHint(_("Wrong password."), true));
                    }
                    break;
            }
        }
        
        // Customise page content (TODO: Move customisation to in-app admin menu. This should be completely empty.
	
        // Set the site name to be displayed on all the pages and the section
	$sitename = "Nuntii";
        $sitesection = "Test area";
        // TODO: Get $sitename from config and $sitesection from $page (maybe even use $page->sitesection in includes/html.php instead?)
        
        $ftime = microtime(true);
        $ttime = $ftime - $stime;
        
        $page->AddToSidebar(new SidebarBox(_("Page served in ") . round($ttime, 3) . "s."));
        
        // Load HTML Boilerplate
        require_once("includes/html.php");