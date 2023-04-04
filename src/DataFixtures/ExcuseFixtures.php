<?php

namespace App\DataFixtures;

use App\Entity\Excuse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExcuseFixtures extends Fixture
{   public const EXCUSES = [

  [701, "Inexcusable", " Meh"],
  [702, "Inexcusable", " Emacs"],
  [703, "Inexcusable", " Explosion"],
  [704, "Inexcusable", " Goto Fail"],
  [705, "Inexcusable", " I wrote the code and missed the necessary validation by an oversight (see 795)"],
  [706, "Inexcusable", " Delete Your Account"],
  [707, "Inexcusable", " Can't quit vi"],
  [710, "Novelty Implementations", " PHP"],
  [711, "Novelty Implementations", " Convenience Store"],
  [712, "Novelty Implementations", " NoSQL"],
  [718, "Novelty Implementations", " I am not a teapot"],
  [719, "Novelty Implementations", " Haskell"],
  [720, "Edge Cases", " Unpossible"],
  [721, "Edge Cases", " Known Unknowns"],
  [722, "Edge Cases", " Unknown Unknowns"],
  [723, "Edge Cases", " Tricky"],
  [724, "Edge Cases", " This line should be unreachable"],
  [725, "Edge Cases", " It works on my machine"],
  [726, "Edge Cases", " It's a feature, not a bug"],
  [727, "Edge Cases", " 32 bits is plenty"],
  [728, "Edge Cases", " It works in my timezone"],
  [730, "Fucking", " Fucking npm"],
  [731, "Fucking", " Fucking Rubygems"],
  [732, "Fucking", " Fucking Unic💩de"],
  [733, "Fucking", " Fucking Deadlocks"],
  [734, "Fucking", " Fucking Deferreds"],
  [736, "Fucking", " Fucking Race Conditions"],
  [735, "Fucking", " Fucking IE"],
  [737, "Fucking", " FuckThreadsing"],
  [738, "Fucking", " Fucking Exactly-once Delivery"],
  [739, "Fucking", " Fucking Windows"],
  [750, "Syntax Errors", " Didn't bother to compile it"],
  [753, "Syntax Errors", " Syntax Error"],
  [754, "Syntax Errors", " Too many semi-colons"],
  [755, "Syntax Errors", " Not enough semi-colons"],
  [756, "Syntax Errors", " Insufficiently polite"],
  [757, "Syntax Errors", " Excessively polite"],
  [759, "Syntax Errors", " Unexpected `T_PAAMAYIM_NEKUDOTAYIM`"],
  [761, "Substance", " Hungover"],
  [762, "Substance", " Stoned"],
  [763, "Substance", " Under-Caffeinated"],
  [764, "Substance", " Over-Caffeinated"],
  [765, "Substance", " Railscamp"],
  [766, "Substance", " Sober"],
  [767, "Substance", " Drunk"],
  [768, "Substance", " Accidentally Took Sleeping Pills Instead Of Migraine Pills During Crunch Week"],
  [771, "Predictable Problems", " Cached for too long"],
  [772, "Predictable Problems", " Not cached long enough"],
  [773, "Predictable Problems", " Not cached at all"],
  [774, "Predictable Problems", " Why was this cached?"],
  [775, "Predictable Problems", " Out of cash"],
  [776, "Predictable Problems", " Error on the Exception"],
  [777, "Predictable Problems", " Coincidence"],
  [778, "Predictable Problems", " Off By One Error"],
  [779, "Predictable Problems", " Off By Too Many To Count Error"],
  [780, "Somebody Else's Problem", " Project owner not responding"],
  [781, "Somebody Else's Problem", " Operations"],
  [782, "Somebody Else's Problem", " QA"],
  [783, "Somebody Else's Problem", " It was a customer request, honestly"],
  [784, "Somebody Else's Problem", " Management, obviously"],
  [785, "Somebody Else's Problem", " TPS Cover Sheet not attached"],
  [786, "Somebody Else's Problem", " Try it now"],
  [787, "Somebody Else's Problem", " Further Funding Required"],
  [788, "Somebody Else's Problem", " Designer's final designs weren't"],
  [789, "Somebody Else's Problem", " Not my department"],
  [791, "Internet crashed", " The Internet shut down due to copyright restrictions"],
  [792, "Internet crashed", " Climate change driven catastrophic weather event"],
  [793, "Internet crashed", " Zombie Apocalypse"],
  [794, "Internet crashed", " Someone let PG near a REPL"],
  [795, "Internet crashed", " heartbleed (see 705)"],
  [796, "Internet crashed", " Some DNS fuckery idno"],
  [797, "Internet crashed", " This is the last page of the Internet. Go back"],
  [798, "Internet crashed", " I checked the db backups cupboard and the cupboard was bare"],
  [799, "Internet crashed", " End of the world"]

];

public function load(ObjectManager $manager): void
{
  foreach (self::EXCUSES as $value) {
    # code...
    $excuse = new Excuse();
    $excuse->setHttpCode($value[0]);
    $excuse->setTag($value[1]);
    $excuse->setMessage($value[2]);
    $manager->persist($excuse);
    $this->addReference('excuse_' . $value[0], $excuse);
  }
  $manager->flush();
}

public function getDependencies()
{
  return [
    UniverseFixtures::class,
  ];
}
}
