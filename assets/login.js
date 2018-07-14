(function(window, document){
    
    $tabLogin = document.querySelector('[data-toggle="tab-login"]');
    $tabSingup = document.querySelector('[data-toggle="tab-singup"]');

    $paneLogin = document.querySelector('[data-toggle="pane-login"]');
    $paneSingup = document.querySelector('[data-toggle="pane-singup"]');
    
    $tabLogin.addEventListener('click', handleLoginClick ,false);
    $tabSingup.addEventListener('click', handleSingupClick ,false);

    function handleLoginClick(event){
        event.preventDefault();
        if($tabSingup.classList.contains('active')){
            $tabLogin.classList.add('active');
            $tabLogin.classList.add('show');

            $tabSingup.classList.remove('active');
            $tabSingup.classList.remove('show');

            $paneLogin.classList.add('active');
            $paneLogin.classList.add('show');

            $paneSingup.classList.remove('active');
            $paneSingup.classList.remove('show');

        }
    }

    function handleSingupClick(event){
        event.preventDefault();
        if($tabLogin.classList.contains('active')){
            $tabSingup.classList.add('active');
            $tabSingup.classList.add('show');

            $tabLogin.classList.remove('active');
            $tabLogin.classList.remove('show');

            $paneSingup.classList.add('active');
            $paneSingup.classList.add('show');

            $paneLogin.classList.remove('active');
            $paneLogin.classList.remove('show');

        }
    }



})(window, document);