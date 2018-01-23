<?php

namespace app\modules\attendance\models;

use Yii;

/**
 * This is the model class for table "tb_karyawan".
 *
 * @property integer $NIK
 * @property string $Nama
 * @property string $Jenis_ID
 * @property string $No_ID
 * @property string $Alamat_Rumah
 * @property integer $No_Telp_Rumah
 * @property integer $No_HP
 * @property integer $No_HP2
 * @property string $Alamat_Email
 * @property string $No_NPWP
 * @property string $No_KPJ
 * @property string $Bank_Rek
 * @property integer $active
 * @property integer $Kode_Departement
 * @property integer $Kode_Jabatan
 * @property string $Tanggal_Masuk
 * @property integer $Masa_Kerja
 * @property string $Status_Kerja
 * @property string $Kontrak_Awal
 * @property string $Kontrak_Akhir
 * @property string $Status
 * @property string $Tempat_Lahir
 * @property string $Tanggal_Lahir
 * @property integer $PIN
 * @property integer $role_id
 * @property string $No_Rek_BCA
 * @property string $Nama_Rek_BCA
 * @property string $No_Rek_BTN
 * @property string $Nama_Rek_BTN
 * @property integer $jatah_cuti
 * @property integer $jatah_ijin
 * @property integer $jatah_sakit
 * @property integer $jatah_terlambat
 */
class TbKaryawan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_karyawan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NIK', 'Nama', 'No_ID', 'No_HP', 'Alamat_Email', 'Tempat_Lahir', 'Tanggal_Lahir'], 'required'],
            [['NIK', 'No_Telp_Rumah', 'No_HP', 'No_HP2', 'active', 'Kode_Departement', 'Kode_Jabatan', 'Masa_Kerja', 'PIN', 'role_id', 'jatah_cuti', 'jatah_ijin', 'jatah_sakit', 'jatah_terlambat'], 'integer'],
            [['Bank_Rek', 'Status_Kerja', 'Status'], 'string'],
            [['Tanggal_Masuk', 'Kontrak_Awal', 'Kontrak_Akhir', 'Tanggal_Lahir'], 'safe'],
            [['Nama', 'No_ID', 'Alamat_Email', 'No_NPWP', 'No_KPJ', 'Tempat_Lahir'], 'string', 'max' => 50],
            [['Jenis_ID'], 'string', 'max' => 7],
            [['Alamat_Rumah'], 'string', 'max' => 100],
            [['No_Rek_BCA'], 'string', 'max' => 250],
            [['Nama_Rek_BCA', 'No_Rek_BTN', 'Nama_Rek_BTN'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NIK' => Yii::t('app', 'Nik'),
            'Nama' => Yii::t('app', 'Nama'),
            'Jenis_ID' => Yii::t('app', 'Jenis  ID'),
            'No_ID' => Yii::t('app', 'No  ID'),
            'Alamat_Rumah' => Yii::t('app', 'Alamat  Rumah'),
            'No_Telp_Rumah' => Yii::t('app', 'No  Telp  Rumah'),
            'No_HP' => Yii::t('app', 'No  Hp'),
            'No_HP2' => Yii::t('app', 'No  Hp2'),
            'Alamat_Email' => Yii::t('app', 'Alamat  Email'),
            'No_NPWP' => Yii::t('app', 'No  Npwp'),
            'No_KPJ' => Yii::t('app', 'No  Kpj'),
            'Bank_Rek' => Yii::t('app', 'Bank  Rek'),
            'active' => Yii::t('app', 'Active'),
            'Kode_Departement' => Yii::t('app', 'Kode  Departement'),
            'Kode_Jabatan' => Yii::t('app', 'Kode  Jabatan'),
            'Tanggal_Masuk' => Yii::t('app', 'Tanggal  Masuk'),
            'Masa_Kerja' => Yii::t('app', 'Masa  Kerja'),
            'Status_Kerja' => Yii::t('app', 'Status  Kerja'),
            'Kontrak_Awal' => Yii::t('app', 'Kontrak  Awal'),
            'Kontrak_Akhir' => Yii::t('app', 'Kontrak  Akhir'),
            'Status' => Yii::t('app', 'Status'),
            'Tempat_Lahir' => Yii::t('app', 'Tempat  Lahir'),
            'Tanggal_Lahir' => Yii::t('app', 'Tanggal  Lahir'),
            'PIN' => Yii::t('app', 'Pin'),
            'role_id' => Yii::t('app', 'Role ID'),
            'No_Rek_BCA' => Yii::t('app', 'No  Rek  Bca'),
            'Nama_Rek_BCA' => Yii::t('app', 'Nama  Rek  Bca'),
            'No_Rek_BTN' => Yii::t('app', 'No  Rek  Btn'),
            'Nama_Rek_BTN' => Yii::t('app', 'Nama  Rek  Btn'),
            'jatah_cuti' => Yii::t('app', 'Jatah Cuti'),
            'jatah_ijin' => Yii::t('app', 'Jatah Ijin'),
            'jatah_sakit' => Yii::t('app', 'Jatah Sakit'),
            'jatah_terlambat' => Yii::t('app', 'Jatah Terlambat'),
        ];
    }

    /**
     * @inheritdoc
     * @return TbKaryawanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TbKaryawanQuery(get_called_class());
    }
}
