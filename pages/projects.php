<div class="container">
    <div class="projects-container clearfix">
        <?php foreach ($page->children as $project): ?>
            <section id="<?php echo $project->slug; ?>" data-image="/assets/img/<?php echo $project->image; ?>">
                <div>
                    <a href="<?php echo $project->slug; ?>">
                        <img src="/assets/img/<?php echo $project->image_small; ?>" />
                    </a>
                    <h2>
                        <a class="container-small" href="<?php echo $project->slug; ?>">
                            <?php echo $project->title; ?>
                        </a>
                    </h2>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</div>