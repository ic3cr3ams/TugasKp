<?php
namespace App\Models;

use App\Library\STTSWebService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;
use App\Models\TkDosen;
use App\Models\UjiTaHeader;

/**
 * Class User,
 * untuk inisialisasi, ada baiknya di try catch karena web service STTS bisa error
 *
 * @property STTSWebService $auth
 */
class User implements Authenticatable {
    protected $auth;
    protected $userID;

    protected $nama;
    protected $kodeRole;
    protected $menu;

    //khusus karyawan
    public $karyawanNIP;

    //khusus dosen
    public $kodeDosen;
        // https://ws.stts.edu/credential/mimi/siteRole/silabus&appname=silabus&Q=Q
    /**
     * Menginisialisasi model User menggunakan $uname yang dimasukkan
     */
    public function __construct($uname) {
        $uname = strtolower($uname);
        $this->auth = new STTSWebService('credential', $uname);

        $this->userID = $uname;
        $this->kodeRole = $this->auth->siteRole('silabus');
        $this->nama = $this->getNamaDariRole();

        if ($this->isDosen()) {
            $this->karyawanNIP = $this->Karyawan()->karyawan_nip;
            $this->kodeDosen = $this->Dosen()->dosen_kode;

            if($this->isKajur()){
                $this->jurusanKajur = $this->getJurusanKajur();
            }
            if($this->isDekan("TEK")){
                $this->jurusanDekan = $this->getJurusanDekan();
                $this->dekanFakultas = "TEKNIK";
            }elseif($this->isDekan("DES")){
                $this->jurusanDekan = $this->getJurusanDekan();
                $this->dekanFakultas = "DESAIN";
            }
        }

        $this->menu = $this->GetMenu();
    }

    /**
     * Mendapatkan nama dari objek user
     * Contoh : Adi Budi
     *
     * @return String
     */
    public function nama() {
        return $this->nama;
    }

    /**
     * Mendapatkan nama dengan jabatannya dari objek user
     * Contoh : Adi Budi, M.Kom
     *
     * @return String
     */
    public function namaDenganJabatan() {
        if ($this->isDosen()) {
            return TkDosen::find($this->kodeDosen)
                ->dosen_nama_sk;
        }
        return $this->nama();
    }

    /**
     * Mendapatkan nama dari dari role user
     *
     * @param  String $role
     * @return String
     */
    protected function getNamaDariRole() {
        switch ($this->kodeRole) {
            case '20':
                return 'Admin SIM';
            case '24':
                return 'Admin BAA';
            case '25':
                return 'Admin BAU';
            case '21':
                return 'Admin Laboratorium';
            case '28':
                return 'Admin Kemahasiswaan';
            case '19':
                return 'Admin PMB';
            case '32':
                return 'Admin Bimbingan Konseling';
            default:
                return ucwords(strtolower($this->auth->nama()));
        }
    }

    /**
     * Mendapatkan nama pendek dari objek user
     * Contoh : Adi B.
     *
     * @return String
     */
    public function namaPendek() {
        $namaPanjang = $this->nama();
        $arr = explode(' ', $namaPanjang);
        if (strlen($arr[0]) > 2) {
            $out = ucwords(strtolower($arr[0]));
            if (sizeof($arr) > 1) $out .= ' ';
            for ($i = 1; $i < sizeof($arr); $i++) {
                $out .= $arr[$i][0] . '.';
            }
            return $out;
        } else {
            return $this->nama;
        }
    }

    /**
     * Fungsi untuk mengecek apakah user yang sedang login punya biodata?
     *
     * @return Boolean
     */
    public function PunyaBiodata() {
        return ($this->kodeRole === '-' && $this->menu !== '-');
    }

    /**
     * Fungsi untuk mengembalikan URL foto profil dari user yang sedang login
     *
     * @return String
     */
    public function SelfieURL() {
        if ($this->isDosen())
            return url("dosen/$this->kodeDosen/foto");
        else {
            $menu = $this->Menu();
            if (file_exists(public_path("img/foto/$menu.svg")))
                return url("img/foto/$menu.svg");
            else return url("img/foto/no_foto.svg");;
        }
    }

    /**
     * Apakah objek user ini adalah dosen?
     *
     * @return bool
     */
    public function isDosen() {
        if (!is_null($this->kodeDosen)) return true;
        return ($this->auth->isDosen() == '1');
    }

    /**
     * Apakah objek user ini adalah alumni?
     *
     * @return bool
     */
    public function isAlumni() {
        return ($this->auth->isWisudawan() == '1');
    }

    /**
     * Apakah objek user ini adalah kepala jurusan?
     *
     * @return bool
     */
    public function isKajur() {
        return ($this->auth->isKajur() == '1');
    }

    /**
     * Dapatkan Array berisi jurusan dari kajur tsb
     *
     * @return Array
     */
    public function getJurusanKajur() {
        if($this->isKajur()){
            $jurKodes =  $this->auth->jurusan_kajur();
            return AkaJurusan::whereIn('jur_kode',$jurKodes)->get();
        }else{
            return [];
        }
    }

    /**
     * Apakah objek user ini adalah Dekan?
     * @param string $fak Fakultasnya apa [NULL|TEK|DES]
     * @return bool
     */
    public function isDekan($fak = "") {
        return ($this->auth->is("DEKAN$fak") == '1');
    }

    /**
     * Dapatkan Array berisi jurusan dari dekan tsb
     *
     * @return Array
     */
    public function getJurusanDekan() {
        if($this->isDekan()){
            $jurKodes = $this->auth->jurusan_dekan();
            return AkaJurusan::whereIn('jur_kode',$jurKodes)->get();
        }else{
            return [];
        }
    }

    /**
     * Apakah objek user ini adalah Warek?
     *
     * @return bool
     */
    public function isWarek($ke = "") {
        return ($this->auth->is("WAREK$ke") == '1');
    }

    /**
     * Apakah objek user ini adalah manajer?
     *
     * @return bool
     */
    public function isManagement() {
        return ($this->auth->isManagement() == '1');
    }

    /**
     * Apakah objek user ini adalah rektor?
     *
     * @return bool
     */
    public function isRektor() {
        return ($this->auth->isManagement() == '1');
    }

    /**
     * Apakah objek user ini adalah kepala ecc?
     *
     * @return bool
     */
    public function isKepECC() {
        return ($this->auth->is("KEPECC") == '1');
    }

    /**
     * Apakah objek user ini adalah karyawan?
     *
     * @return bool
     */
    public function isKaryawan() {
        return ($this->auth->isKaryawan() == '1');
    }

    /**
     * Mendapatkan koleksi berupa data Dosen
     * jika yang login adalah dosen
     *
     * @return App\Models\TkDosen
     */
    public function Dosen() {
        return TkDosen::where("karyawan_nip", $this->karyawanNIP)->first();
    }

    /**
     * Mendapatkan koleksi berupa data Karyawan
     * jika yang login adalah karyawan
     *
     * @return App\Models\TkKaryawan
     */
    public function Karyawan() {
        return TkKaryawan::where("karyawan_intranet", $this->userID)->first();
    }

    /**
     * Mendapatkan kode menu yang akan tampil di side nav
     *
     * @return string
     */
    public function Menu() {
        return $this->menu;
    }

    /**
     * Inisialisasi mendapatkan kode menu
     * (untuk menghindari menghubungi web service berkali kali)
     *
     * @return string
     */
    private function GetMenu() {
        if ($this->isManagement()) {
            return 'rektor';
        } else if ($this->isDekan()) {
            return 'dekan';
        } else if ($this->isKajur()) {
            return 'kajur';
        } else if ($this->isDosen()) {
            return 'dosen';
        } else {
            switch ($this->kodeRole) {
                case '20':
                    return 'admin';
                case '24':
                    return 'baak';
                case '25':
                    return 'bau';
                case '21':
                    return 'lab';
                case '28':
                    return 'kemahasiswaan';
                case '19':
                    return 'pmb';
                case '32':
                    return 'bk';
                case 'ortu':
                    return 'mahasiswa';
            }
        }
        return '-';
    }

    public function hasRole($roles)
    {
        if ($roles == $this->roles()) {
            return true;
        }
        return false;
    }

    /**
     * Apakah passwordnya benar?
     *
     * @return bool
     */
    public function isPassCorrect($pass) {
        try {
            //perlu === '1'...
            return $this->auth->login($pass) == 1;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getAuthIdentifierName() {
        return $this->userID;
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->userID;
    }

    /**
     * Fungsi ini... rasanya untuk mendapatkan hashed password,
     * namun tidak dipakai karena autentikasi nya lewat WebService
     * saat ini...
     * @return string
     */
    public function getAuthPassword() {
        Log::warning('Called User->getAuthPassword '.$this->userID);
        return '';
    }

    /**
     * Fungsi ini tidak dipakai, untuk remember akan diimplementasi
     * pada SSO iSTTS.
     * @return string
     */
    public function getRememberToken() {
        Log::warning('Called User->getRememberToken '.$this->userID);
        return '';
     }

    /**
     * Fungsi ini tidak dipakai, untuk remember akan diimplementasi
     * pada SSO iSTTS.
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value) {
        Log::warning('Called User->setRememberToken '.$this->userID);
    }

    /**
     * Fungsi ini tidak dipakai, untuk remember akan diimplementasi
     * pada SSO iSTTS
     * @return string
     */
    public function getRememberTokenName() {
        Log::warning('Called User->getRememberTokenName '.$this->userID);
        return '';
    }
}
