<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/public/css/lib/index.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/pages/product.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/shared.css" />

  <script src="/public/scripts/dist/product.js"></script>
  <title>Pantryy</title>
</head>
<body>
  <div class="page">
    <?php if(isset($product)): ?>
      <aside class="drawer" id="drawer--editItem">
        <div class="-align-center -justify-space-between">
          <h2 class="text__heading--6--heavy">
            Edit product
          </h2>
          <button class="button button--sm--squared button--borderless--neutral" data-drawer-node="xButton">
            <div class="-inline-flex -fill--neutral_3"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Content / clear"><mask id="mask0_70_7154" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="5" y="5" width="14" height="14"><g id="Icon Mask"><path id="Round" d="M18.3 5.97436C18.1131 5.78711 17.8595 5.68187 17.595 5.68187C17.3305 5.68187 17.0768 5.78711 16.89 5.97436L12 10.8544L7.10997 5.96436C6.92314 5.77711 6.66949 5.67188 6.40497 5.67188C6.14045 5.67188 5.8868 5.77711 5.69997 5.96436C5.30997 6.35436 5.30997 6.98436 5.69997 7.37436L10.59 12.2644L5.69997 17.1544C5.30997 17.5444 5.30997 18.1744 5.69997 18.5644C6.08997 18.9544 6.71997 18.9544 7.10997 18.5644L12 13.6744L16.89 18.5644C17.28 18.9544 17.91 18.9544 18.3 18.5644C18.69 18.1744 18.69 17.5444 18.3 17.1544L13.41 12.2644L18.3 7.37436C18.68 6.99436 18.68 6.35436 18.3 5.97436Z" fill="black"/></g></mask><g mask="url(#mask0_70_7154)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg></div>
          </button>
        </div>
        <form id="form--addItem">
          <div class="-mt--1000 -pt--500">
            <label class="input__label -full-width">
              <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Name</span></div>
              <input name="name" class="input__input -bg--inverted -full-width" value="<?= $product->getName() ?>" placeholder="Name..." />
              <?php if(isset($messages) && isset($messages['name'])): ?>
                <div class="-pl--700 -mt--400">
                  <span class="text__paragraph--small--regular">
                    <span class="-color--state_error">
                      <?= $messages['name'] ?>
                    </span>
                  </span>
                </div>
              <?php endif; ?>
            </label>
          </div>
          <div class="-mt--800">
            <label class="input__label -full-width">
              <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Image</span></div>
              <input name="image" class="input__input -bg--inverted -full-width" type="file" />
              <?php if(isset($messages) && isset($messages['image'])): ?>
                <div class="-pl--700 -mt--400">
                  <span class="text__paragraph--small--regular">
                    <span class="-color--state_error">
                      <?= $messages['image'] ?>
                    </span>
                  </span>
                </div>
              <?php endif; ?>
            </label>
          </div>
          <div class="-mt--800">
            <label class="input__label -full-width">
              <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Description</span></div>
              <textarea name="description" class="input__input -bg--inverted -full-width" placeholder="Description..."><?= $product->getDescription() ?></textarea>
              <?php if(isset($messages) && isset($messages['description'])): ?>
                <div class="-pl--700 -mt--400">
                  <span class="text__paragraph--small--regular">
                    <span class="-color--state_error">
                      <?= $messages['description'] ?>
                    </span>
                  </span>
                </div>
              <?php endif; ?>
            </label>
          </div>
          <div class="-mt--800">
            <div class="-full-width">
              <div class="-pl--700 -pb--500"><span class="text__paragraph--base--heavy">Measurement unit</span></div>
              <div class="-align-center -gap--700">
                <?php if (isset($units)): ?>
                  <?php foreach ($units as $unit): ?>
                    <label>
                      <input
                        type="radio"
                        name="unit"
                        value="<?= $unit->getId() ?>"
                        <?= $unit->getId() === $product->getMeasurementUnit()->getId() ? "checked" : "" ?>
                        class="-mr--200"
                      />
                      <span class="text__paragraph--base--regular"><?= $unit->getName()?></span>
                    </label>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <?php if(isset($messages) && isset($messages['unit'])): ?>
                <div class="-pl--700 -mt--400">
                  <span class="text__paragraph--small--regular">
                    <span class="-color--state_error">
                      <?= $messages['unit'] ?>
                    </span>
                  </span>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="-mt--1000 -pt--500">
            <button class="button button--sm button--filled--primary -full-width -justify-center">
            <span class="text__action--button--small">
              <span class="-color--inverted" href="#">
                Submit
              </span>
            </span>
            </button>
          </div>
          <div class="-mt--600">
            <button type="button" class="button button--sm button--borderless--neutral -full-width -justify-center" data-drawer-node="cancelButton">
            <span class="text__action--button--small">
              <span class="-color--neutral_5" href="#">
                Cancel
              </span>
            </span>
            </button>
          </div>
        </form>
      </aside>
    <?php endif; ?>
    <nav class="nav">
      <div class="nav__content">
        <img src="/public/images/shared/logo.png" class="nav__logo logo--small -pt--600 -pl--600 -mt--500 -ml--500" />
        <ul class="nav__items">
          <li class="nav__item nav__item--active">
            <a href="/pantry" class="nav__link text__action--button--medium -full-width">
              <svg class="-fill--neutral_black" width="24" height="25" viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg"><g id="Action / dashboard"><mask id="mask0_70_4193" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="3" y="3" width="18" height="19"><g id="Icon Mask"><path id="Round" fill-rule="evenodd" clip-rule="evenodd" d="M10 13.2646H4C3.45 13.2646 3 12.8146 3 12.2646V4.26465C3 3.71465 3.45 3.26465 4 3.26465H10C10.55 3.26465 11 3.71465 11 4.26465V12.2646C11 12.8146 10.55 13.2646 10 13.2646ZM10 21.2646H4C3.45 21.2646 3 20.8146 3 20.2646V16.2646C3 15.7146 3.45 15.2646 4 15.2646H10C10.55 15.2646 11 15.7146 11 16.2646V20.2646C11 20.8146 10.55 21.2646 10 21.2646ZM14 21.2646H20C20.55 21.2646 21 20.8146 21 20.2646V12.2646C21 11.7146 20.55 11.2646 20 11.2646H14C13.45 11.2646 13 11.7146 13 12.2646V20.2646C13 20.8146 13.45 21.2646 14 21.2646ZM13 8.26465V4.26465C13 3.71465 13.45 3.26465 14 3.26465H20C20.55 3.26465 21 3.71465 21 4.26465V8.26465C21 8.81465 20.55 9.26465 20 9.26465H14C13.45 9.26465 13 8.81465 13 8.26465Z" fill="black"/></g></mask><g mask="url(#mask0_70_4193)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg>
              <span class="-color--neutral_2">Pantry</span>
            </a>
          </li>
          <li class="nav__item">
            <a href="#" class="nav__link text__action--button--medium -full-width">
              <svg class="-fill--neutral_6" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Places / room service"><mask id="mask0_70_10999" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="2" y="5" width="20" height="15"><g id="Icon Mask"><path id="Round" fill-rule="evenodd" clip-rule="evenodd" d="M14 7.26465C14 7.54465 13.94 7.81465 13.84 8.05465C17.75 8.86465 20.73 12.1946 21 16.2646H3C3.27 12.1946 6.25 8.86465 10.16 8.05465C10.06 7.81465 10 7.54465 10 7.26465C10 6.16465 10.9 5.26465 12 5.26465C13.1 5.26465 14 6.16465 14 7.26465ZM22 18.2646C22 17.7146 21.55 17.2646 21 17.2646H3C2.45 17.2646 2 17.7146 2 18.2646C2 18.8146 2.45 19.2646 3 19.2646H21C21.55 19.2646 22 18.8146 22 18.2646Z" fill="black"/></g></mask><g mask="url(#mask0_70_10999)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg>
              <span class="-color--neutral_5">Recipes</span>
            </a>
          </li>
          <li class="nav__item">
            <a href="#" class="nav__link text__action--button--medium -full-width">
              <svg class="-fill--neutral_6" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Content / paste"><mask id="mask0_70_7305" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="3" y="1" width="18" height="23"><g id="Icon Mask"><path id="Round" fill-rule="evenodd" clip-rule="evenodd" d="M19 3.26465H14.82C14.4 2.10465 13.3 1.26465 12 1.26465C10.7 1.26465 9.6 2.10465 9.18 3.26465H5C3.9 3.26465 3 4.16465 3 5.26465V21.2646C3 22.3646 3.9 23.2646 5 23.2646H19C20.1 23.2646 21 22.3646 21 21.2646V5.26465C21 4.16465 20.1 3.26465 19 3.26465ZM12 3.26465C12.55 3.26465 13 3.71465 13 4.26465C13 4.81465 12.55 5.26465 12 5.26465C11.45 5.26465 11 4.81465 11 4.26465C11 3.71465 11.45 3.26465 12 3.26465ZM5 20.2646C5 20.8146 5.45 21.2646 6 21.2646H18C18.55 21.2646 19 20.8146 19 20.2646V6.26465C19 5.71465 18.55 5.26465 18 5.26465H17V6.26465C17 7.36465 16.1 8.26465 15 8.26465H9C7.9 8.26465 7 7.36465 7 6.26465V5.26465H6C5.45 5.26465 5 5.71465 5 6.26465V20.2646Z" fill="black"/></g></mask><g mask="url(#mask0_70_7305)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg>
              <span class="-color--neutral_5">To-buy list</span>
            </a>
          </li>
        </ul>
        <ul class="nav__items -mt--auto -mb--900">
          <li class="nav__item">
            <a href="#" class="nav__link text__action--button--medium -full-width">
              <svg class="-fill--neutral_6" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Action / settings"><mask id="mask0_70_5007" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="2" y="2" width="20" height="21"><g id="Icon Mask"><path id="Round" fill-rule="evenodd" clip-rule="evenodd" d="M19.5022 12.2646C19.5022 12.6046 19.4722 12.9246 19.4322 13.2446L21.5422 14.8946C21.7322 15.0446 21.7822 15.3146 21.6622 15.5346L19.6622 18.9946C19.5422 19.2146 19.2822 19.3046 19.0522 19.2146L16.5622 18.2146C16.0422 18.6046 15.4822 18.9446 14.8722 19.1946L14.4922 21.8446C14.4622 22.0846 14.2522 22.2646 14.0022 22.2646H10.0022C9.75216 22.2646 9.54216 22.0846 9.51216 21.8446L9.13216 19.1946C8.52216 18.9446 7.96216 18.6146 7.44216 18.2146L4.95216 19.2146C4.73216 19.2946 4.46216 19.2146 4.34216 18.9946L2.34216 15.5346C2.22216 15.3146 2.27216 15.0446 2.46216 14.8946L4.57216 13.2446C4.53216 12.9246 4.50216 12.5946 4.50216 12.2646C4.50216 11.9346 4.53216 11.6046 4.57216 11.2846L2.46216 9.63465C2.27216 9.48465 2.21216 9.21465 2.34216 8.99465L4.34216 5.53465C4.46216 5.31465 4.72216 5.22465 4.95216 5.31465L7.44216 6.31465C7.96216 5.92465 8.52216 5.58465 9.13216 5.33465L9.51216 2.68465C9.54216 2.44465 9.75216 2.26465 10.0022 2.26465H14.0022C14.2522 2.26465 14.4622 2.44465 14.4922 2.68465L14.8722 5.33465C15.4822 5.58465 16.0422 5.91465 16.5622 6.31465L19.0522 5.31465C19.2722 5.23465 19.5422 5.31465 19.6622 5.53465L21.6622 8.99465C21.7822 9.21465 21.7322 9.48465 21.5422 9.63465L19.4322 11.2846C19.4722 11.6046 19.5022 11.9246 19.5022 12.2646ZM8.50216 12.2646C8.50216 14.1946 10.0722 15.7646 12.0022 15.7646C13.9322 15.7646 15.5022 14.1946 15.5022 12.2646C15.5022 10.3346 13.9322 8.76465 12.0022 8.76465C10.0722 8.76465 8.50216 10.3346 8.50216 12.2646Z" fill="black"/></g></mask><g mask="url(#mask0_70_5007)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg>
              <span class="-color--neutral_5">Settings</span>
            </a>
          </li>
          <li class="nav__item">
            <a href="#" class="nav__link text__action--button--medium -full-width">
              <svg class="-fill--neutral_7" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Navigation / arrow back_ios"><mask id="mask0_70_10317" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="2" width="12" height="20"><g id="Icon Mask"><path id="Round" d="M17.0019 3.24934C16.5119 2.75934 15.7219 2.75934 15.2319 3.24934L6.92189 11.5593C6.53189 11.9493 6.53189 12.5793 6.92189 12.9693L15.2319 21.2793C15.7219 21.7693 16.5119 21.7693 17.0019 21.2793C17.4919 20.7893 17.4919 19.9993 17.0019 19.5093L9.76189 12.2593L17.0119 5.00934C17.4919 4.52934 17.4919 3.72934 17.0019 3.24934Z" fill="black"/></g></mask><g mask="url(#mask0_70_10317)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg>
              <span class="-color--neutral_7">Log out</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="divider--vertical -full-height -ml--auto"></div>
    </nav>
    <main class="page__main">
      <div class="toolbar -py--700 -my--400 -px--1000">
        <form action="/pantry">
          <input name="search" class="input__input input__input--ghost -bg--neutral_8" value="<?= $_GET["search"] ?>" placeholder="Search..." />
        </form>
        <div class="-align-center -gap--500">
          <button class="button button--sm--squared button--borderless--neutral">
            <div class="-inline-flex -fill--neutral_5"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Action / delete"><mask id="mask0_70_4210" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="5" y="3" width="14" height="19"><g id="Icon Mask"><path id="Round" fill-rule="evenodd" clip-rule="evenodd" d="M15.5 4.26465H18C18.55 4.26465 19 4.71465 19 5.26465C19 5.81465 18.55 6.26465 18 6.26465H6C5.45 6.26465 5 5.81465 5 5.26465C5 4.71465 5.45 4.26465 6 4.26465H8.5L9.21 3.55465C9.39 3.37465 9.65 3.26465 9.91 3.26465H14.09C14.35 3.26465 14.61 3.37465 14.79 3.55465L15.5 4.26465ZM8 21.2646C6.9 21.2646 6 20.3646 6 19.2646V9.26465C6 8.16465 6.9 7.26465 8 7.26465H16C17.1 7.26465 18 8.16465 18 9.26465V19.2646C18 20.3646 17.1 21.2646 16 21.2646H8Z" fill="black"/></g></mask><g mask="url(#mask0_70_4210)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg></div>
          </button>
          <button class="button button--sm--squared button--borderless--neutral" id="drawer_button--editItem">
            <div class="-inline-flex -fill--neutral_3"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Action / settings"><mask id="mask0_70_5007" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="2" y="2" width="20" height="21"><g id="Icon Mask"><path id="Round" fill-rule="evenodd" clip-rule="evenodd" d="M19.5022 12.2646C19.5022 12.6046 19.4722 12.9246 19.4322 13.2446L21.5422 14.8946C21.7322 15.0446 21.7822 15.3146 21.6622 15.5346L19.6622 18.9946C19.5422 19.2146 19.2822 19.3046 19.0522 19.2146L16.5622 18.2146C16.0422 18.6046 15.4822 18.9446 14.8722 19.1946L14.4922 21.8446C14.4622 22.0846 14.2522 22.2646 14.0022 22.2646H10.0022C9.75216 22.2646 9.54216 22.0846 9.51216 21.8446L9.13216 19.1946C8.52216 18.9446 7.96216 18.6146 7.44216 18.2146L4.95216 19.2146C4.73216 19.2946 4.46216 19.2146 4.34216 18.9946L2.34216 15.5346C2.22216 15.3146 2.27216 15.0446 2.46216 14.8946L4.57216 13.2446C4.53216 12.9246 4.50216 12.5946 4.50216 12.2646C4.50216 11.9346 4.53216 11.6046 4.57216 11.2846L2.46216 9.63465C2.27216 9.48465 2.21216 9.21465 2.34216 8.99465L4.34216 5.53465C4.46216 5.31465 4.72216 5.22465 4.95216 5.31465L7.44216 6.31465C7.96216 5.92465 8.52216 5.58465 9.13216 5.33465L9.51216 2.68465C9.54216 2.44465 9.75216 2.26465 10.0022 2.26465H14.0022C14.2522 2.26465 14.4622 2.44465 14.4922 2.68465L14.8722 5.33465C15.4822 5.58465 16.0422 5.91465 16.5622 6.31465L19.0522 5.31465C19.2722 5.23465 19.5422 5.31465 19.6622 5.53465L21.6622 8.99465C21.7822 9.21465 21.7322 9.48465 21.5422 9.63465L19.4322 11.2846C19.4722 11.6046 19.5022 11.9246 19.5022 12.2646ZM8.50216 12.2646C8.50216 14.1946 10.0722 15.7646 12.0022 15.7646C13.9322 15.7646 15.5022 14.1946 15.5022 12.2646C15.5022 10.3346 13.9322 8.76465 12.0022 8.76465C10.0722 8.76465 8.50216 10.3346 8.50216 12.2646Z" fill="black"/></g></mask><g mask="url(#mask0_70_5007)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg></div>
          </button>
        </div>
      </div>
      <div class="divider--horizontal -full-width"></div>
      <?php if(isset($product)): ?>
        <div class="-pt--900 -px--1000 product">
          <div class="-full-width product__left_column">
            <img src="/public/images/uploads/<?= $product->getImage() ?>" class="product__image">
            <button class="button button--sm button--ghost--neutral">
              <div class="-pr--500 -inline-flex"><svg class="-fill--neutral_3" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Content / add"><mask id="mask0_70_7092" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="5" y="5" width="14" height="15"><g id="Icon Mask"><path id="Round" d="M18 13.2646H13V18.2646C13 18.8146 12.55 19.2646 12 19.2646C11.45 19.2646 11 18.8146 11 18.2646V13.2646H6C5.45 13.2646 5 12.8146 5 12.2646C5 11.7146 5.45 11.2646 6 11.2646H11V6.26465C11 5.71465 11.45 5.26465 12 5.26465C12.55 5.26465 13 5.71465 13 6.26465V11.2646H18C18.55 11.2646 19 11.7146 19 12.2646C19 12.8146 18.55 13.2646 18 13.2646Z" fill="black"/></g></mask><g mask="url(#mask0_70_7092)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg></div>
              <span class="text__action--button--small">
              <span class="-color--neutral_3" href="#">
                Add to a shopping list
              </span>
            </span>
            </button>
          </div>
          <div class="-full-width product__right_column">
            <div class="-full-width product__info">
              <div>
                <h1 class="text__heading--2--regular" ><?= $product->getName() ?></h1>
                <div class="-mt--700">
                  <p class="text__paragraph--small--light">Available:</p>
                  <p class="text__paragraph--base--regular item_description__amount">4 kg / 12pcs.</p>
                </div>
              </div>
              <button class="button button--sm button--ghost--primary">
              <span class="text__action--button--small">
                <span class="-color--action_primary" href="#">
                  See recipes
                </span>
              </span>
                <div class="-pl--500 -inline-flex"><svg class="-fill--action_primary" width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Navigation / arrow forward"><mask id="mask0_70_10339" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="4" y="4" width="16" height="16"><g id="Icon Mask"><path id="Round" d="M5.20874 13.2644H16.3787L11.4987 18.1444C11.1087 18.5344 11.1087 19.1744 11.4987 19.5644C11.8887 19.9544 12.5187 19.9544 12.9087 19.5644L19.4987 12.9744C19.8887 12.5844 19.8887 11.9544 19.4987 11.5644L12.9187 4.96436C12.7319 4.77711 12.4783 4.67188 12.2137 4.67188C11.9492 4.67188 11.6956 4.77711 11.5087 4.96436C11.1187 5.35436 11.1187 5.98436 11.5087 6.37436L16.3787 11.2644H5.20874C4.65874 11.2644 4.20874 11.7144 4.20874 12.2644C4.20874 12.8144 4.65874 13.2644 5.20874 13.2644Z" fill="black"/></g></mask><g mask="url(#mask0_70_10339)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg></div>
              </button>
            </div>
            <div class="-mt--900">
              <span class="text__paragraph--base--light">
                <?= $product->getDescription() ?>
              </span>
            </div>
            <div class="-mt--900 -pt--900">
              <div class="-align-center">
                <h2 class="text__heading--4--regular">Purchase history</h2>
                <button class="button button--sm--squared button--borderless--neutral ">
                  <div class="-inline-flex -fill--neutral_3"><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="Content / add"><mask id="mask0_70_7092" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="5" y="5" width="14" height="15"><g id="Icon Mask"><path id="Round" d="M18 13.2646H13V18.2646C13 18.8146 12.55 19.2646 12 19.2646C11.45 19.2646 11 18.8146 11 18.2646V13.2646H6C5.45 13.2646 5 12.8146 5 12.2646C5 11.7146 5.45 11.2646 6 11.2646H11V6.26465C11 5.71465 11.45 5.26465 12 5.26465C12.55 5.26465 13 5.71465 13 6.26465V11.2646H18C18.55 11.2646 19 11.7146 19 12.2646C19 12.8146 18.55 13.2646 18 13.2646Z" fill="black"/></g></mask><g mask="url(#mask0_70_7092)"><rect id="Color Fill" y="0.264648" width="24" height="24" fill="#858C94"/></g></g></svg>
                  </div>
                </button>
              </div>
              <table class="-mt--500 table">
                <thead>
                <tr>
                  <th class="text__paragraph--base--regular">Date</th>
                  <th class="text__paragraph--base--regular">Amount bought</th>
                  <th class="text__paragraph--base--regular">Amount used</th>
                  <th class="text__paragraph--base--regular">Spoils in</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="text__paragraph--base--light">2022.04.01</td>
                  <td class="text__paragraph--base--light">0.5 kg / 1pc.</td>
                  <td class="text__paragraph--base--light">0 kg</td>
                  <td class="text__paragraph--base--light">1 day</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </main>
  </div>
</body>
</html>
