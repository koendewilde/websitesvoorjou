<?php get_header(); ?>

<main>

    <section id="section-page" class="section-404">

        <div id="page-intro-wrapper" class="wrapper-outer clearfix">

            <header>
                <div class="wrapper-small">
                    <h1 class="page-title">
                        <?php if( get_field('kdw_page404_title', 'options') ){ echo esc_attr( get_field('kdw_page404_title', 'options') ); } else { echo 'Pagina niet gevonden'; } ?>
                    </h1>
                </div>
            </header>
        </div>

        <div id="page-content" class="wrapper-outer clearfix">

            <div class="wrapper-small">

                <div class="entry-content medium serif">
                    <?php if( get_field('kdw_page404_content', 'options') ){ echo get_field('kdw_page404_content', 'options'); } ?>
                </div>

            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
