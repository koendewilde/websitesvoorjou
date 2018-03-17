<?php get_header(); ?>

<main>

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <section id="section-single">

        <div id="page-content" class="clearfix wrapper-outer">

            <div class="wrapper-small clearfix">

                <div class="wrapper-content">

                    <header>

                        <h1 class="post-title">
                            <?php the_title(); ?>
                        </h1>
                        <div class="single-post-meta single-post-meta-first">
                            <?php the_date(); ?>
                        </div>

                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>


                    <div class="single-footer-wrapper">

                    </div>

                </div>

            </div>

        </div>

    </section>

    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
