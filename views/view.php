<?

/**
 * View class
 */
class View
{
	/**
	 * controller
	 * 
	 * @var object
	 * @access protected
	 */
	protected $controller;

	/**
	 * include
	 * 
	 * @var string
	 * @access protected
	 */
	protected $include;
	
	/**
	 * header
	 * 
	 * @var array
	 * @access public
	 * @static
	 */
	public static $header = array(
		'start' => 'Start transaction (init, start)',
		'result' => 'Get result (result)',
		'close' => 'Allow/Revoke two-step transaction (close)',
		'details' => 'Get details (details)',
		'refund' => 'Refund (refund)',
		'selectOcp' => 'One Click Payment (without any intermediate page)',
		'startOcp' => 'One Click Payment (without any intermediate page)',
		'startRP' => 'Start recurring payment (initRP, startRP)',
		'invoice' => 'Invoice (invoice)',
		'oneClickTokenCancel' => 'One Click Token Cancel (oneClickTokenCancel)',
	);
	
	/**
	 * Saferpay payment methods
	 * 
	 * @var array
	 * @access public
	 * @static
	 */
	public static $saferpayPaymentMethods = array(
		'AMEX' => 'AMEX',
		'DIRECTDEBIT' => 'DIRECTDEBIT',
		'INVOICE' => 'INVOICE',
		'BONUS' => 'BONUS',
		'DINERS' => 'DINERS',
		'EPRZELEWY' => 'EPRZELEWY',
		'EPS' => 'EPS',
		'GIROPAY' => 'GIROPAY',
		'IDEAL' => 'IDEAL',
		'JCB' => 'JCB',
		'MAESTRO' => 'MAESTRO',
		'MASTERCARD' => 'MASTERCARD',
		'MYONE' => 'MYONE',
		'PAYPAL' => 'PAYPAL',
		'POSTCARD' => 'POSTCARD',
		'POSTFINANCE' => 'POSTFINANCE',
		'SAFERPAYTEST' => 'SAFERPAYTEST',
		'SOFORT' => 'SOFORT',
		'VISA' => 'VISA',
		'VPAY' => 'VPAY',
	);

	/**
	 * Saferpay wallets
	 * 
	 * @var array
	 * @access public
	 * @static
	 */
	public static $saferpayWallets = array(
		'MASTERPASS' => 'MASTERPASS',
	);

	/**
	 * Wirecard payment types
	 * 
	 * @var array
	 * @access public
	 * @static
	 */
	public static $wirecardPaymentTypes = array(
		'SELECT' => 'Select it on Wirecard side',
		'BANCONTACT_MISTERCASH' => 'Bancontact/Mister Cash',
		'CCARD' => 'Credit Card, Maestro SecureCode',
		'CCARD-MOTO' => 'Credit Card - Mail Order and Telephone Order',
		'EKONTO' => 'eKonto',
		'EPAY_BG' => 'ePay.bg',
		'EPS' => 'eps Online-wire',
		'GIROPAY' => 'giropay',
		'IDL' => 'iDEAL',
		'MONETA' => 'moneta.ru',
		'MPASS' => 'mpass',
		'PRZELEWY24' => 'Przelewy24',
		'PAYPAL' => 'PayPal',
		'PBX' => 'paybox',
		'POLI' => 'POLi',
		'PSC' => 'paysafecard',
		'QUICK' => '@Quick',
		'SEPA-DD' => 'SEPA Direct Debit',
		'SKRILLDIRECT' => 'Skrill Direct',
		'SKRILLWALLET' => 'Skrill Digital Wallet',
		'SOFORTUEBERWEISUNG' => 'SOFORT Banking',
		'TATRAPAY' => 'TatraPay',
		'TRUSTLY' => 'Trustly',
		'TRUSTPAY' => 'TrustPay',
		'VOUCHER' => 'My Voucher',
	);

	/**
	 * Contructor
	 *
	 * @param object $controller
	 * @return void
	 * @access public
	 */
	public function __construct(Controller $controller)
	{
		$this->controller = $controller;
		$this->include = $this->controller->action . '.html';
		$this->responseUrl = (($_SERVER['HTTPS'] == 'on') ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . '/response.php';
		$this->call();
	}
	
	/**
	 * Call
	 *
	 * @return void
	 * @access protected
	 */
	protected function call()
	{
		if (!empty($this->controller->action)) {
			if (method_exists(__CLASS__, $this->controller->action)) {
				call_user_func(array($this, $this->controller->action));
			}
			
			$this->output();
		}
	}
	
	/**
	 * Output
	 *
	 * @return void
	 * @access protected
	 */
	protected function output()
	{
		require_once(PROJECT_PATH . DS . 'views' . DS . 'frame.php');
	}
	
	/**
	 * Start
	 *
	 * @return void
	 * @access protected
	 */
	protected function start()
	{
		$this->setPhpInclude();
	}
	
	/**
	 * StartOCP
	 *
	 * @return void
	 * @access protected
	 */
	protected function startOcp()
	{
		$this->setPhpInclude();
	}
	
	/**
	 * StartRP
	 *
	 * @return void
	 * @access protected
	 */
	protected function startRP()
	{
		$this->setPhpInclude();
	}

	/**
	 * Invoice
	 *
	 * @return void
	 * @access protected
	 */
	protected function invoice()
	{
		if (!empty($this->controller->data)) {
			$this->setPhpInclude();
			require_once(PROJECT_PATH . DS . 'views' . DS . $this->include);
		}	
	}
	
	/**
	 * SetPhpInclude
	 *
	 * @return void
	 * @access protected
	 */
	protected function setPhpInclude()
	{
		$this->include = $this->controller->action . '.php';
	}
}
