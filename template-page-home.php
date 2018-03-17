<?php 
/* Template Name: Homepage */
get_header(); ?>

<main>

    <section id="section-page-home">

        <div class="wrapper-outer">
            <div class="wrapper-main">
                <div id="links-wrapper" class="wrapper-content">
                    <?php the_content(); ?>
                </div>

            </div>
        </div>
        <?php kdw_row_extra_page_content(); ?>

    </section>

</main>

<?php get_footer(); ?>
