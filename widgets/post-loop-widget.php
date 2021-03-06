<?php 
class Post_Loop_Widget extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        $widget_options = [
            'classname' => 'Post_Loop_Widget',
            'description' => __('A post loop using bootstrap elements'),
        ];
    
        parent::__construct('sls_post_loop_widget', __('[SLS] Post Loop Widget'),$widget_options);
    }
    function form( $instance ) {
        // Output admin widget options form
        $defaults = [
			'title'    => '',
            'cols'     => 3,
            'img_crop' => '',
            'img_height' => 300,
            'post_type'=>__('any'),
            'category'=>-1,
            'tags'=>'',
            'show_excerpt'=>'',
            'show_img'=>'',
            'show_cat'=>'',
		];
		
		// Parse current settings with defaults
        extract( wp_parse_args( ( array ) $instance, $defaults ) );
        $title_id = $this->get_field_id('title');
        $cols_id= $this->get_field_id('col');
        $img_crop_id = $this->get_field_id('img_crop');
        $img_height_id = $this->get_field_id('img_height');
        $post_type_id = $this->get_field_id('post_type');
       // $post_types_names = array_merge(['any','posts','pages'], get_post_types(['public'=>true,'_builtin'=>false], 'names'));
        $post_types_names = array_merge(['any','post','page'], get_post_types(['public'=>true,'_builtin'=>false], 'names'));
        $categories = get_categories([ 'orderby' => 'name', 'order' => 'ASC'] ); //get all categories 
        $category_id = $this->get_field_id('category');
        $tags_id = $this->get_field_id('tags');
        $show_excerpt_id = $this->get_field_id('show_excerpt');
        $show_img_id = $this->get_field_id('show_img');

        // html template for admin 
        ?>
        <p>
            <!-- title -->
            <label for=<?=$title_id?>> <?=__('Title:')?> </label>
            <input id='<?=$title_id?>' name='<?=$this->get_field_name('title')?>' type='text' value='<?=esc_attr( $title )?>' placeholder='<?=_e('Super cool loop')?>'>            
        </p>
        <p>
            <!-- columns -->
            <label for ='<?$cols_id?>'> <?=__('col-md:')?> </label>
            <select id='<?$cols_id?>' name='<?=$this->get_field_name('cols')?>'>
                <?php for($col=1; $col<=12; $col++):?>
                  <option value='<?=$col?>' <?= $col == $cols?'selected':''?> > <?=$col?> </option>
                <?php endfor;?>
            </select>       
        </p>
        <p>
        <!-- post type -->
        <label for ='<?=$post_type_id?>'> <?=__('Display posts of type:')?> </label>
            <select id='<?$post_type_id?>' name='<?=$this->get_field_name('post_type')?>'>
                <?php foreach($post_types_names as $name):?>
                  <option value='<?=esc_attr( $name )?>' <?= $name == $post_type?'selected':''?> > <?=esc_attr( $name )?> </option>
                <?php endforeach;?>
            </select>     
        </p>
        <p>
        <!-- post category -->
        <label for ='<?=$category_id?>'> <?=__('Display posts of category:')?> </label>
            <select id='<?$category_id?>' name='<?=$this->get_field_name('category')?>'>
                <option value="-1" <?=$category == -1?'selected':''; ?>><?=__('any')?> </option>
                <?php foreach($categories as $category_obj):?>
                  <option value='<?=esc_attr( $category_obj->term_id)?>' <?= $category_obj->term_id == $category?'selected':''?> > <?=esc_attr( $category_obj->name )?> </option>
                <?php endforeach;?>
            </select>     
        </p>
        <p>
            <!-- tags -->
            <label for=<?=$tags_id?>> <?=__('Display posts of tag(s):')?> </label>
            <input id='<?=$tags_id?>' name='<?=$this->get_field_name('tags')?>' type='text' value='<?=esc_attr( $tags )?>' placeholder='<?=_e('seperate tags with ","')?>'>            
        </p>
        <p>
            <h4> Featured Image </h4>
            </hr>
            <!-- show img -->
            <input id="<?=$show_img_id?>" name="<?php echo esc_attr( $this->get_field_name( 'show_img' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_img ); ?> />
			<label for="<?=$show_img_id?>"><?=__( 'Enable featured image ', 'text_domain' )?></label>
			<!-- crop img -->
            <input id="<?=$img_crop_id?>" name="<?php echo esc_attr( $this->get_field_name( 'img_crop' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $img_crop ); ?> />
			<label for="<?=$img_crop_id?>"><?=__( 'Image Crop', 'text_domain' )?></label>
            <!--img height -->
            <label for="<?=$img_height_id?>"><?=__( 'Image Height', 'text_domain' )?></label>
			<input id="<?=$img_height_id?>" name="<?php echo esc_attr( $this->get_field_name( 'img_height' ) ); ?>" type="number" value="<?=esc_attr($img_height)?>"> 
         
	    	</p>
            <h4> Content Options </h4>
            <input id="<?=$show_excerpt_id?>" name="<?php echo esc_attr( $this->get_field_name( 'show_excerpt' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_excerpt ); ?> />
			<label for="<?=$show_excerpt_id?>"><?=__( 'Enable excerpt ', 'text_domain' )?></label>
    
        <?php
        //end of html template for admin
    }
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance; 
        $instance['title'] = !empty($new_instance['title'])? strip_tags($new_instance['title']) :'';
        $instance['cols'] = !empty($new_instance['cols'])?$new_instance['cols']:4;
        $instance['img_crop'] = !empty($new_instance['img_crop'])?$new_instance['img_crop']:'';
        $instance['show_img'] = !empty($new_instance['show_img'])?$new_instance['show_img']:'';
        $instance['img_height'] = !empty($new_instance['img_height'])?$new_instance['img_height']:300;
        $instance['post_type'] = !empty($new_instance['post_type'])?$new_instance['post_type']:'any';
        $instance['category'] = !empty($new_instance['category'])?$new_instance['category']:-1;
        $instance['tags'] = !empty($new_instance['tags'])? strip_tags( $new_instance['tags']):-1;
        $instance['show_excerpt'] = !empty($new_instance['show_excerpt'])?$new_instance['show_excerpt']:'';

       
       /* if(!empty($new_instance['tags'])){
            $tempTags = explode(',',sanitize_text_field( $new_instance['tags']));
            $i = 0; 
            while ($tempTags){
                $tempTags[$i] = trim($tempTags[$i]);
                $i++;
            }
            $instance['tags'] = implode(',',$tempTags);
        }
        */
        return $instance;
    }
    function widget( $args, $instance ) {
        // Widget output
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $cols =  isset($instance['cols'])?$instance['cols']:4;
        //image settings 
        $img_crop =  isset($instance['img_crop'])?$instance['img_crop']:'';
        $show_excerpt =  isset($instance['show_excerpt'])?$instance['show_excerpt']:'';
        $show_img =  isset($instance['show_img'])?$instance['show_img']:'';
        $img_height =  isset($instance['img_height'])?$instance['img_height']:300;
        $post_type =  isset($instance['post_type'])? $instance['post_type']:'any';
        $category =  isset($instance['category'])? $instance['category']:-1;
        $tags =  isset($instance['tags'])? $instance['tags']:-1;
        //the title
        echo $before_widget.'<div class="col-12">'.$before_title.$title.$after_title.'</div>';
        $q_args = array(
            'post_type' =>  $post_type,
            'orderby'   => 'date',
            'order'     => 'ASC',
            'cat'       => $category != -1? $category:'',
            'tag'       => $tags != -1? $tags : ''
        );
        $query = new WP_Query( $q_args  );
         if ( $query->have_posts() ){ 
             $img_class = '';
             $img_style = '';
             if($img_crop == 1){
                 $img_style = "height:".$img_height.'px;';
                 $img_class = "cover"; 
             }
             while ( $query->have_posts() ){ 
                 $query->the_post(); 
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                 ?>
                 <div  class="col-md-<?=esc_attr($cols)?>"  >
                 <div class="card mb-4">
                 <?php if(has_post_thumbnail() && $show_img ==1):?>
                    <img style="<?=$img_style?>" class="card-img-top <?=$img_class?>" src="<?=$image[0]?>">
                 <?php endif;?>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted"><?=the_category( ',' )?></h6>
                        <h5 class="card-title"><?=the_title()?></h5>
                        <?php if($show_excerpt == 1):?>
                            <p class="card-text"><?=the_excerpt()?></p>
                        <?php endif;?>
                    </div>
                </div>
                </div>
                 <?php
             } 
        }     
                echo $after_widget;
    }
}
