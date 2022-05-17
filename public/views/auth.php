<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="public/css/lib/index.css" />
  <link rel="stylesheet" type="text/css" href="public/css/pages/auth.css" />
  <link rel="stylesheet" type="text/css" href="public/css/shared.css" />
  <title>Pantryy | Account</title>
</head>
<body>
  <main class="page">
    <img src="public/images/shared/logo_full.png" class="logo--big">
    <div class="page_content">
      <div class="tabs_container">
        <a href="/login" class="tab <?= $type == 'login' ? 'tab--active' : '' ?>">
          <span class="text__action--button--medium">
            <span class="-color--neutral_3">
              Log in
            </span>
          </span>
        </a>
        <a href="/register" class="tab <?= $type == 'register' ? 'tab--active' : '' ?>">
          <span class="text__action--button--medium">
            <span class="-color--neutral_3">
              Register
            </span>
          </span>
        </a>
      </div>
      <?php if($type === 'login'): ?>
        <form class="form -full-width -mt--1000" action="/login" method="POST" >
          <div class="form__inputs_container">
            <div class="input -full-width">
              <label class="input__label -full-width">
                <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Email</span></div>
                <input name="email" class="input__input -full-width" placeholder="Email..." />
              </label>
            </div>
            <div class="input -full-width">
              <label class="input__label -full-width">
                <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Password</span></div>
                <input name="password" type="password" class="input__input -full-width" placeholder="Password..." />
              </label>
            </div>
          </div>
          <a href="#" class="text__action--link--small -mt--600 -ml--auto">
            <span class="-color--action_default">
              Forgot password?
            </span>
          </a>
          <button type="submit" class="button button--md button--filled--primary -mt--1000 -full-width -justify-center">
            <span class="text__action--button--large">
              <span class="-color--inverted" href="#">
                Log in
              </span>
            </span>
            <div class="-inline-flex -pl--500 -mt--200"><svg class="-fill--inverted" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Navigation / arrow forward"><mask id="mask0_70_10339" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="4" y="4" width="16" height="16"><g id="Icon Mask"><path id="Round" d="M5.20874 13.2644H16.3787L11.4987 18.1444C11.1087 18.5344 11.1087 19.1744 11.4987 19.5644C11.8887 19.9544 12.5187 19.9544 12.9087 19.5644L19.4987 12.9744C19.8887 12.5844 19.8887 11.9544 19.4987 11.5644L12.9187 4.96436C12.7319 4.77711 12.4783 4.67188 12.2137 4.67188C11.9492 4.67188 11.6956 4.77711 11.5087 4.96436C11.1187 5.35436 11.1187 5.98436 11.5087 6.37436L16.3787 11.2644H5.20874C4.65874 11.2644 4.20874 11.7144 4.20874 12.2644C4.20874 12.8144 4.65874 13.2644 5.20874 13.2644Z" fill="black"/></g></mask><g mask="url(#mask0_70_10339)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg></div>
          </button>
        </form>
      <?php elseif($type === 'register'): ?>
        <form class="form -full-width -mt--1000">
          <div class="form__inputs_container">
            <div class="input -full-width">
              <label class="input__label -full-width">
                <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Email</span></div>
                <input name="email" class="input__input -full-width" placeholder="Email..." />
              </label>
            </div>
            <div class="input -full-width">
              <label class="input__label -full-width">
                <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Password</span></div>
                <input name="password" type="password" class="input__input -full-width" placeholder="Password..." />
              </label>
            </div>
            <div class="input -full-width">
              <label class="input__label -full-width">
                <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Confirm password</span></div>
                <input name="repeated_password" type="password" class="input__input -full-width" placeholder="Password..." />
              </label>
            </div>
          </div>
          <button class="button button--md button--filled--primary -mt--1000 -full-width -justify-center">
            <span class="text__action--button--large">
              <span class="-color--inverted" href="#">
                Sign up
              </span>
            </span>
            <div class="-inline-flex -pl--500 -mt--200"><svg class="-fill--inverted" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Navigation / arrow forward"><mask id="mask0_70_10339" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="4" y="4" width="16" height="16"><g id="Icon Mask"><path id="Round" d="M5.20874 13.2644H16.3787L11.4987 18.1444C11.1087 18.5344 11.1087 19.1744 11.4987 19.5644C11.8887 19.9544 12.5187 19.9544 12.9087 19.5644L19.4987 12.9744C19.8887 12.5844 19.8887 11.9544 19.4987 11.5644L12.9187 4.96436C12.7319 4.77711 12.4783 4.67188 12.2137 4.67188C11.9492 4.67188 11.6956 4.77711 11.5087 4.96436C11.1187 5.35436 11.1187 5.98436 11.5087 6.37436L16.3787 11.2644H5.20874C4.65874 11.2644 4.20874 11.7144 4.20874 12.2644C4.20874 12.8144 4.65874 13.2644 5.20874 13.2644Z" fill="black"/></g></mask><g mask="url(#mask0_70_10339)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg></div>
          </button>
        </form>
      <?php endif; ?>
    </div>
  </main>
  <div class="bg_photos_container">
    <img src="public/images/auth/onion.jpg" class="bg_photo bg_photo--right" />
    <img src="public/images/auth/broccoli.jpg" class="bg_photo bg_photo--top" />
    <img src="public/images/auth/garlic.jpg" class="bg_photo bg_photo--left" />
  </div>
</body>
</html>
