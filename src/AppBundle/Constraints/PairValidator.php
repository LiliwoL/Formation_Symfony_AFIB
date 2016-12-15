<?php


namespace AppBundle\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author
 *
 * @link
 */
class PairValidator extends ConstraintValidator
{

	public function validate($value, Constraint $constraint)
	{
		if ( $value %2 !== 0 ) {

			$this->context->buildViolation($constraint->message)
				->setParameter('{{ value }}', $this->formatValue($value))
				->addViolation();

		}
		else{

			return;

		}
	}

	public function isLongitude( $valeur )
	{

	}

	public function isLatitude( $valeur )
	{

	}
}
