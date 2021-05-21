<div class="breadcrumb-option">
    <div class="container">
       <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="<?= _url('/'); ?>"><i class="fa fa-home"></i> Accueil</a>
                    <span>Contact</span>
                </div>
            </div>
       </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Map Begin -->
<!-- <div class="map">
    <div class="container">
       <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2942.5524090066037!2d-71.10245469994108!3d42.47980730490846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3748250c43a43%3A0xe1b9879a5e9b6657!2sWinter%20Street%20Public%20Parking%20Lot!5e0!3m2!1sen!2sbd!4v1577299251173!5m2!1sen!2sbd"
            height="585" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div> -->
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
       <div class="row">
            <div class="col-lg-4">
                <div class="contact__address">
                    <div class="section-title">
                        <h2>Contact info</h2>
                    </div>
                    <ul>
                        <!-- <li>
                            <i class="fa fa-map-marker"></i>
                            <h5>Address</h5>
                            <p>Los Angeles Gournadi, 1230 Bariasl</p>
                        </li> -->
                        <li>
                            <i class="fa fa-phone"></i>
                            <h5>Téléphone</h5>
                            <span>+221 77 685 30 43</span>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <h5>Email</h5>
                            <p>contact@armandkoffi.com</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="contact__form">
                    <div class="section-title">
                        <h2>Ecrivez nous !</h2>
                    </div>
                    <form action="<?= _url($module_base."send_contact_mail") ?>" method="post">
                        <div class="input__list">
                            <input type="text" name="contact_name" placeholder="Votre nom complet ! " required>
                            <input type="email" name="contact_email" placeholder="Votre email ! " required>
                            <input type="text" name="contact_object" placeholder="Objet !" required>
                        </div>
                        <textarea placeholder="Contenue" name="contact_content"></textarea>
                        <button type="submit" class="site-btn">Envoyez</button>
                    </form>
                </div>
            </div>
       </div>
    </div>
</section>
