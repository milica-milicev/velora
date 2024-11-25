<div class="contact">
    <div class="container">
        <div class="contact__container">
            <div class="contact__col">
                <div class="contact__info">
                    <h2 class="contact-item__title">Imate pitanje?</h2>
                    <p class="contact-item__text">Slobodno nas kontaktirajte za sva pitanja, povratne informacije ili pomoć koja vam je potrebna. Naš posvećeni tim je na raspolaganju da ponudi brzu i prilagođenu pomoć, osiguravajući da vaše iskustvo kupovine bude glatko i prijatno.</p>
                </div>
            </div>
            <div class="contact__col">
                <?php // echo do_shortcode('[contact-form-7 id="139121c" title="Bez naslova"]'); ?>
<!-- <div class="contact__form">
<div class="contact__form-half-col">
[text* your-name autocomplete:name placeholder "Ime*"]
</div>
<div class="contact__form-half-col">
[email* your-email autocomplete:email placeholder "E-mail*"]
</div>
<div class="contact__form-wide-col">
[textarea* message placeholder] Poruka* [/textarea*]
</div>
</div>
<div class="contact__form-submit-btn-wrap">
[submit class:btn "Pošalji"]
</div> -->
                <form action="">
                    <div class="contact__form">
                        <div class="contact__form-half-col">
                            <input type="text" id="name" name="name" placeholder="Ime*">
                        </div>
                        <div class="contact__form-half-col">
                            <input type="email" id="email" name="email" placeholder="E-mail*">
                        </div>
                        <div class="contact__form-wide-col">
                            <textarea id="message" name="message" rows="4" cols="50" placeholder="Poruka*"></textarea>
                        </div>
                    </div>
                    <button class="btn" type="submit">Pošalji</button>
                </form>
            </div>
        </div>
    </div>
</div>