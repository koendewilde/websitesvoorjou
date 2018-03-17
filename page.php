<?php get_header(); ?>

<main>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <section id="section-page">


        <div id="page-intro-wrapper" class="wrapper-outer clearfix">

            <header>
                <div class="wrapper-small">
                    <h1 class="page-title">
                        <?php the_title(); ?>
                    </h1>
                </div>
            </header>
        </div>

        <div id="page-content" class="wrapper-outer clearfix">

            <div class="wrapper-small">

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

            </div>

        </div>

    </section>

    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
