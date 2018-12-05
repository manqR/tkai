<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property string $idsiswa
 * @property string $nama_lengkap
 * @property string $jenis_kelamin
 * @property string $nisn
 * @property string $no_seri_ijazah_smp
 * @property string $no_seri_skhun_smp
 * @property string $no_ujian_nasional
 * @property string $nik
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $agama
 * @property string $alamat
 * @property string $kelurahan
 * @property string $kecamatan
 * @property string $kota
 * @property string $provinsi
 * @property string $transportasi
 * @property string $tlp_rumah
 * @property string $hp
 * @property string $email
 * @property int $status_kps
 * @property string $no_kps
 * @property int $tinggi_badan
 * @property double $berat_badan
 * @property int $jarak_tempat_tinggal
 * @property int $waktu_tempuh
 * @property int $jml_saudara
 * @property string $user_create
 * @property string $date_create
 * @property string $user_update
 * @property string $date_update
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswa', 'nama_lengkap', 'jenis_kelamin', 'nisn', 'no_seri_ijazah_smp', 'no_seri_skhun_smp', 'no_ujian_nasional', 'nik', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'transportasi', 'hp', 'email', 'status_kps', 'no_kps', 'tinggi_badan', 'berat_badan', 'jarak_tempat_tinggal', 'waktu_tempuh', 'jml_saudara'], 'required'],
            [['tanggal_lahir', 'date_create', 'date_update'], 'safe'],
            [['alamat'], 'string'],
            [['tinggi_badan', 'jarak_tempat_tinggal', 'waktu_tempuh', 'jml_saudara'], 'integer'],
            [['berat_badan'], 'number'],
            [['idsiswa', 'jenis_kelamin', 'tlp_rumah'], 'string', 'max' => 10],
            [['nama_lengkap', 'tempat_lahir', 'agama', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'transportasi', 'email', 'user_create', 'user_update'], 'string', 'max' => 50],
            [['nisn', 'no_seri_ijazah_smp', 'no_seri_skhun_smp', 'no_ujian_nasional', 'nik', 'no_kps'], 'string', 'max' => 20],
            [['hp'], 'string', 'max' => 14],
            [['status_kps'], 'string', 'max' => 4],
            [['idsiswa'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsiswa' => 'Idsiswa',
            'nama_lengkap' => 'Nama Lengkap',
            'jenis_kelamin' => 'Jenis Kelamin',
            'nisn' => 'Nisn',
            'no_seri_ijazah_smp' => 'No Seri Ijazah Smp',
            'no_seri_skhun_smp' => 'No Seri Skhun Smp',
            'no_ujian_nasional' => 'No Ujian Nasional',
            'nik' => 'Nik',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'agama' => 'Agama',
            'alamat' => 'Alamat',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kota' => 'Kota',
            'provinsi' => 'Provinsi',
            'transportasi' => 'Transportasi',
            'tlp_rumah' => 'Tlp Rumah',
            'hp' => 'Hp',
            'email' => 'Email',
            'status_kps' => 'Status Kps',
            'no_kps' => 'No Kps',
            'tinggi_badan' => 'Tinggi Badan',
            'berat_badan' => 'Berat Badan',
            'jarak_tempat_tinggal' => 'Jarak Tempat Tinggal',
            'waktu_tempuh' => 'Waktu Tempuh',
            'jml_saudara' => 'Jml Saudara',
            'user_create' => 'User Create',
            'date_create' => 'Date Create',
            'user_update' => 'User Update',
            'date_update' => 'Date Update',
        ];
    }
}
