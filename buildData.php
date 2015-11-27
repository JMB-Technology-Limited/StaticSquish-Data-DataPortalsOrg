<?php


$url = "https://raw.githubusercontent.com/okfn/dataportals.org/master/data/portals.csv";
$dir = __DIR__;


mkdir($dir.DIRECTORY_SEPARATOR.'data');


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
$data = curl_exec($ch);
curl_close($ch);

$tempname = tempnam(sys_get_temp_dir(),'dataportalsorg');
file_put_contents($tempname, $data);

if (($handle = fopen($tempname, "r")) !== FALSE) {
    // Lose Header Row
    $data = fgetcsv($handle, 1000, ",");
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

    $id = $data['0'];
    $id = str_replace("/","",$id);
    $id = str_replace("''","",$id);
    $id = str_replace("|","",$id);
    $id = str_replace("_","-",$id);
    $id = str_replace("--","-",$id);
    $id = str_replace("--","-",$id);
    $id = str_replace("--","-",$id);
    $id = str_replace("--","-",$id);
    $id = str_replace("--","-",$id);

    mkdir($dir. DIRECTORY_SEPARATOR. 'data' . DIRECTORY_SEPARATOR. $id);


    $location = null;
    if ($data[12] != ' #N/A') {

        $bits = explode(",",$data[12]);
        $location = "https://www.openstreetmap.org/#map=18/".trim($bits[0])."/".trim($bits[1]);

    }

    $tags = explode(" ",$data[8] );

    $out = "[title]\n\n".
        $data[1].
        "\n\n[url]\n\n".
        $data[2].
        "\n\n[author]\n\n".
        $data[3].
        "\n\n[publisher]\n\n".
        $data[4].
        "\n\n[issued]\n\n".
        $data[5].
        "\n\n[publisher_classification]\n\n".
        $data[6].
        "\n\n[description]\n\n".
        $data[7].
        "\n\n[tags]\n\n".
        implode("\n", $tags).
        "\n\n[license_id]\n\n".
        $data[9].
        "\n\n[license_url]\n\n".
        $data[10].
        "\n\n[place]\n\n".
        $data[11].
        "\n\n[location]\n\n".
        $location.
        "\n\n[country]\n\n".
        $data[13].
        "\n\n[language]\n\n".
        $data[14].
        "\n\n[status]\n\n".
        $data[15].
        "\n\n[metadatacreated]\n\n".
        $data[16].
        "\n\n[generator]\n\n".
        $data[17].
        "\n\n[api_endpoint]\n\n".
        $data[18].
        "\n\n[api_type]\n\n".
        $data[19].
        "\n\n[full_metadata_download]\n\n".
        $data[20]
        ;

    file_put_contents($dir. DIRECTORY_SEPARATOR. 'data' . DIRECTORY_SEPARATOR. $id. DIRECTORY_SEPARATOR. 'data.txt', $out);



    }
    fclose($handle);
}
