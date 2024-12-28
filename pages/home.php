<!--
主頁：會放一些廣告之類的吧，可以想像成學校主頁(?
-->
<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets\images\4fa0e5d9-965f-4ba5-85fb-1c18f092a858.jpg" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets\images\5b96cb1fbda94a10baf11f10abf57c58_Q50.png" class="d-block w-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/images/v2-475835bc94aea7dce36f10f46baffe87_r.webp" class="d-block w-60" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Add Custom CSS -->
<style>
  .carousel-inner {
    text-align: center; /* 確保圖片居中 */
  }
  
  .carousel-item img {
    max-width: 80%; /* 設定最大寬度，這樣可以縮小圖片 */
    margin: 0 auto; /* 確保圖片在容器內居中 */
    display: block; /* 確保圖片是區塊顯示，便於居中 */
  }
</style>