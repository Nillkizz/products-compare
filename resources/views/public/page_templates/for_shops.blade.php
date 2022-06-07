<x-public.layouts.main>
  <style>
    .xml_tag {
      color: red;
    }
  </style>
  <div class="content content-full">
    {!! $page->content !!}

    <div style="margin: 15px; padding: 5px; border: 1px solid #c7c7c7;">
      XML fails jāizvieto internetā, piemēram, <span
        style="color: blue;">https://www.shop-name.lv/export/pcmpare.xml</span>.
      <br>Failā nedrīkst iekļaut alkohola un tabakas izstrādājuma preces.

      <div style="margin-top: 5px;">
        Tagu apraksts:

        <div style="margin: 8px;">
          <span class="xml_tag">&lt;name&gt;</span>
          <div style="margin-left: 8px;">
            Produkta nosaukums. Vēlams tikai ražotājs, modelis un kods. Pieļaujamais garums: 200 simboli <br>
            Obligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;link&gt;</span>
          <div style="margin-left: 8px;">
            Produkta saite līdz 500 simboliem <br>
            Obligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;price&gt;</span>
          <div style="margin-left: 8px;">
            Cena EUR. Skaitliska vērtībai ar punktu kā decimālo atdalītāju <br>
            Obligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;category_full&gt;</span>
          <div style="margin-left: 8px;">
            Pilns kategorijas nosaukums ar visām virskategorijām. Pieļaujamais garums: 200 simboli <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;category_link&gt;</span>
          <div style="margin-left: 8px;">
            Kategorijas saite līdz 500 simboliem <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;image&gt;</span>
          <div style="margin-left: 8px;">
            Attēla saite līdz 500 simboliem. Maksimālais attēla izmērs ir 16MB <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;in_stock&gt;</span>
          <div style="margin-left: 8px;">
            Pieejamo preču daudzumu noliktavā, kas pieejamas piegādei Rīgā līdz 4 darba dienu laikā <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;brand&gt;</span>
          <div style="margin-left: 8px;">
            Produkta preču zīme <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;model&gt;</span>
          <div style="margin-left: 8px;">
            Produkta modelis <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;color&gt;</span>
          <div style="margin-left: 8px;">
            Produkta krāsa angļu vai latviešu valodā <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;mpn&gt;</span>
          <div style="margin-left: 8px;">
            Produkta MPN (Manufacturer Part Number) kods <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;gtin&gt;</span>
          <div style="margin-left: 8px;">
            Produkta GTIN (Global Trade Item Number) kods. Tas var būt arī EAN, UPC, JAN, ISBN kods <br>
            Neobligāta vērtība </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;used&gt;</span>
          <div style="margin-left: 8px;">
            Lietotām, atjaunotām, demo un bojātām precēm obligāti jānorāda vērtība "1" <br>
          </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;adult&gt;</span>
          <div style="margin-left: 8px;">
            Seksuāla, kailuma, erotiska vai intīma rakstura produktiem obligāti jānorāda vērtība "yes". Vērtība: yes/no.
            Obligāts tags intīmpreču tirgotājiem <br>
          </div>
        </div>
        <div style="margin: 8px;">
          <span class="xml_tag">&lt;over_the_counter_medicine&gt;</span>
          <div style="margin-left: 8px;">
            Zāļu tirgotājiem jānorāda vērtība "1", ja produkts ir bezrecepšu zāle <br>
          </div>
        </div>

        <br>Ja kādā tagā nav ko norādīt vai tas netiek atbalstīts un vērtība nav obligāta, tad to var atstāt tukšu vai
        nenorādīt vispār
        <br>Cena jānorāda galējā, par kuru preci iespējams iegādāties, iekļaujot visas papildus izmaksas bez piegādes
        <br>Failam jābūt UTF-8 kodējumā
        <br>Faila atgriezšanas laikam jābūt līdz 5 minūtēm
      </div>

      <pre
        style="font-size: 14px; margin: 10px; color: red; font-family: Arial; overflow: scroll; border: 1px solid gray; padding: 5px;"><span class="xml_tag">&lt;?xml version="1.0" encoding="utf-8" ?&gt;</span>
  <span class="xml_tag">&lt;root&gt;</span>
  <span class="xml_tag">&lt;item&gt;</span>
    <span class="xml_tag">&lt;name&gt;</span>Samsung Galaxy S8 G950F Black<span class="xml_tag">&lt;/name&gt;</span>
    <span class="xml_tag">&lt;link&gt;</span>http://www.shop-name.lv/info/SamsungGalaxyS8G950FBlack/<span class="xml_tag">&lt;/link&gt;</span>
    <span class="xml_tag">&lt;price&gt;</span>305.77<span class="xml_tag">&lt;/price&gt;</span>
    <span class="xml_tag">&lt;image&gt;</span>http://www.shop-name.lv/images/SamsungGalaxyS8G950FBlack.jpg<span class="xml_tag">&lt;/image&gt;</span>
    <span class="xml_tag">&lt;category_full&gt;</span>Mobilie telefoni <span>&amp;</span>gt;<span>&amp;</span>gt; Samsung<span class="xml_tag">&lt;/category_full&gt;</span>
    <span class="xml_tag">&lt;category_link&gt;</span>http://www.shop-name.lv/Samsung<span class="xml_tag">&lt;/category_link&gt;</span>
    <span class="xml_tag">&lt;brand&gt;</span>Samsung<span class="xml_tag">&lt;/brand&gt;</span>
    <span class="xml_tag">&lt;model&gt;</span>Galaxy S8<span class="xml_tag">&lt;/model&gt;</span> <span class="xml_comment"></span>
    <span class="xml_tag">&lt;color&gt;</span>Black<span class="xml_tag">&lt;/color&gt;</span> <span class="xml_comment"></span>
    <span class="xml_tag">&lt;mpn&gt;</span>SM-G950F<span class="xml_tag">&lt;/mpn&gt;</span>
    <span class="xml_tag">&lt;gtin&gt;</span>0644391356614,644391356614<span class="xml_tag">&lt;/gtin&gt;</span>
    <span class="xml_tag">&lt;in_stock&gt;</span>7<span class="xml_tag">&lt;/in_stock&gt;</span>
    <span class="xml_tag">&lt;delivery_cost_riga&gt;</span>2.99<span class="xml_tag">&lt;/delivery_cost_riga&gt;</span> <span class="xml_comment">&lt;!-- Maksimālā piegādes cena uz adresi Rīgā. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_latvija&gt;</span>5.99<span class="xml_tag">&lt;/delivery_latvija&gt;</span> <span class="xml_comment">&lt;!-- Maksimālā piegādes cena uz adresi Latvijā. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_latvijas_pasts&gt;</span>1<span class="xml_tag">&lt;/delivery_latvijas_pasts&gt;</span> <span class="xml_comment">&lt;!-- Piegāde uz Latvijas pasta nodaļu. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_dpd_paku_bode&gt;</span>0<span class="xml_tag">&lt;/delivery_dpd_paku_bode&gt;</span> <span class="xml_comment">&lt;!-- Piegāde uz DPD Pickup punktiem. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_pasta_stacija&gt;</span>0<span class="xml_tag">&lt;/delivery_pasta_stacija&gt;</span> <span class="xml_comment">&lt;!-- Piegāde uz Pasta Stacijas punktiem. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_omniva&gt;</span><span class="xml_tag">&lt;/delivery_omniva&gt;</span> <span class="xml_comment">&lt;!-- Piegāde uz Omniva punktiem. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_circlek&gt;</span>1.50<span class="xml_tag">&lt;/delivery_circlek&gt;</span> <span class="xml_comment">&lt;!-- Piegāde uz Circle K degvielas stacijām. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_venipak&gt;</span>1.50<span class="xml_tag">&lt;/delivery_venipak&gt;</span> <span class="xml_comment">&lt;!-- Piegāde uz Venipak Pickup punktiem. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_days_riga&gt;</span>4<span class="xml_tag">&lt;/delivery_days_riga&gt;</span> <span class="xml_comment">&lt;!-- Maksimālais darba dienu skaits preces piegādei Rīgā. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;delivery_days_latvija&gt;</span>6<span class="xml_tag">&lt;/delivery_days_latvija&gt;</span> <span class="xml_comment">&lt;!-- Maksimālais darba dienu skaits preces piegādei Latvijā. Neobligāts. Skaitliska vērtība. --&gt;</span>
    <span class="xml_tag">&lt;used&gt;</span><span class="xml_tag">&lt;/used&gt;</span>
    <span class="xml_tag">&lt;adult&gt;</span>no<span class="xml_tag">&lt;/adult&gt;</span>

  <span class="xml_tag">&lt;/item&gt;</span>
  <span class="xml_tag">&lt;item&gt;</span>
    ...
  <span class="xml_tag">&lt;/item&gt;</span>
  <span class="xml_tag">&lt;/root&gt;</span>
</pre>


    </div>
  </div>
</x-public.layouts.main>
