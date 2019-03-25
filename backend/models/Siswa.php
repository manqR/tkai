<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "siswa".
 *
 * @property string $nis
 * @property string $kode_siswa
 * @property int $idcabang
 * @property int $idkategori
 * @property string $nisn
 * @property string $no_registrasi
 * @property double $biaya_registrasi
 * @property string $nama_lengkap
 * @property string $nama_panggilan
 * @property string $agama
 * @property string $jenis_kelamin
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $alamat
 * @property string $tlp_darurat
 * @property string $nama_darurat
 * @property string $status_hubungan
 * @property string $tlp
 * @property string $nama_ayah
 * @property string $nama_ibu
 * @property string $pekerjaan_ayah
 * @property string $pekerjaan_ibu
 * @property string $email
 * @property string $tahun_input
 * @property string $tgl_input
 * @property int $status
 * @property int $urutan
 *
 * @property Cabang $cabang
 * @property Kategori $kategori
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nis', 'kode_siswa', 'idcabang', 'idkategori', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'tlp_darurat', 'nama_darurat', 'status_hubungan', 'tahun_input', 'status'], 'required'],
            [['idcabang', 'idkategori', 'status'], 'integer'],
            [['biaya_registrasi'], 'number'],
            [['tanggal_lahir', 'tahun_input', 'tgl_input'], 'safe'],
            [['nis', 'kode_siswa', 'nisn', 'no_registrasi'], 'string', 'max' => 20],
            [['nama_lengkap', 'nama_panggilan', 'agama', 'tempat_lahir', 'tlp_darurat', 'nama_darurat', 'status_hubungan', 'tlp', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'email'], 'string', 'max' => 50],
            [['jenis_kelamin'], 'string', 'max' => 1],
            [['alamat'], 'string', 'max' => 1000],
            [['idcabang'], 'exist', 'skipOnError' => true, 'targetClass' => Cabang::className(), 'targetAttribute' => ['idcabang' => 'idcabang']],
            [['idkategori'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::className(), 'targetAttribute' => ['idkategori' => 'idkategori']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nis' => 'Nis',
            'kode_siswa' => 'Kode Siswa',
            'idcabang' => 'Idcabang',
            'idkategori' => 'Idkategori',
            'nisn' => 'Nisn',
            'no_registrasi' => 'No Registrasi',
            'biaya_registrasi' => 'Biaya Registrasi',
            'nama_lengkap' => 'Nama Lengkap',
            'nama_panggilan' => 'Nama Panggilan',
            'agama' => 'Agama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'tlp_darurat' => 'Tlp Darurat',
            'nama_darurat' => 'Nama Darurat',
            'status_hubungan' => 'Status Hubungan',
            'tlp' => 'Tlp',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            'pekerjaan_ayah' => 'Pekerjaan Ayah',
            'pekerjaan_ibu' => 'Pekerjaan Ibu',
            'email' => 'Email',
            'tahun_input' => 'Tahun Input',
            'tgl_input' => 'Tgl Input',
            'status' => 'Status',
            'urutan' => 'Urutan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabang()
    {
        return $this->hasOne(Cabang::className(), ['idcabang' => 'idcabang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['idkategori' => 'idkategori']);
    }
    public function getKuitansi()
    {
        return $this->hasOne(Kuitansi::className(), ['kode_siswa' => 'kode_siswa']);
    }
}
