function menuitem($conn) {

    $menu = $conn->prepare("SELECT * from menu_cat");
    $menu->execute();
    $menuorder = $conn->prepare("SELECT * from menu_cat ORDER BY id ASC LIMIT 1");
    $menuorder->execute();
    $menufirst = $conn->prepare("SELECT id FROM menu_cat LIMIT 1");
    $menufirst->execute();
    $category_id = (int)$menufirst->fetch(PDO::FETCH_ASSOC)['id'];
    while ($myresult = $menu->fetch(PDO::FETCH_ASSOC)) :
        $item = $conn->prepare("SELECT * from menu_items WHERE category_id = $myresult[category_id]");
        $item->execute();       
        echo '<div class="tab-pane fade';
        if($myresult['id'] == $category_id){
            echo ' show active"';
        }
        else {
            echo '"';}
         echo ' id="pills-home'.$myresult['id'].'" role="tabpanel" aria-labelledby="pills-home-'.$myresult['id'].'">
        <div class="row">';
        while ($myitem = $item->fetch(PDO::FETCH_ASSOC)) :
            echo '<div class="col-lg-6 col-md-6">
            <div class="single_delicious d-flex align-items-center">
                <div class="thumb">
                <img src="'.$myitem['img_path'].'" alt="" width="168px" height="168px">
                </div>
                <div class="info">
                <h3>'.$myitem['product_name'].'</h3>
                <p>'.$myitem['description'].'</p>
                <span>'.$myitem['price'].' TL</span>
                </div>
            </div>
        </div>';
        endwhile;
        echo '</div>
        </div>';
    endwhile;
}
